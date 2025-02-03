<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\ClusterBuku;
use App\Models\Clustering;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClusteringController extends Controller
{
    public function clusterBuku()
    {
        $buku = Buku::with('kategori')->get();

        if ($buku->isEmpty()) {
            return response()->json([
                'message' => 'Data buku kosong'
            ], 404);
        }

        $data = [];
        foreach ($buku as $item) {
            $nama_kategori = $item->kategori->nama_kategori;
            $sub_kategori = $item->kategori->sub_kategori;
            // Contoh fitur: id_kategori, tahun_terbit (bisa disesuaikan)
            $data[] = [
                $item->kategori_id,
                $this->labelEncode($sub_kategori),
                $item->tahun_terbit,
                $this->labelEncode($nama_kategori)
            ];
        }

        $data = $this->normalizeData($data);

        // Jalankan Hierarchical Clustering manual
        $clusters = $this->hierarchicalClustering($data);

        try {
            ClusterBuku::truncate();

            // Loop melalui hasil clustering
            foreach ($clusters as $label_klaster => $indices) {
                foreach ($indices as $index) {
                    // Ambil buku berdasarkan index
                    $buku_terpilih = $buku[$index];

                    // Simpan ke tabel klaster_buku
                    ClusterBuku::create([
                        'buku_id' => $buku_terpilih->id,
                        'nama_kelompok' => 'Klaster ' . ($label_klaster + 1)
                    ]);
                }
            }

            return response()->json(['message' => 'Clustering berhasil dilakukan.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    private function normalizeData(array $data): array
    {
        $minYear = min(array_column($data, 2)); // Ambil tahun terbit terkecil
        $maxYear = max(array_column($data, 2)); // Ambil tahun terbit terbesar

        $normalizedData = [];
        foreach ($data as $item) {
            $normalizedData[] = [
                $item[0], // kategori_id
                $item[1], // sub_kategori
                ($item[2] - $minYear) / ($maxYear - $minYear), // tahun_terbit (dinormalisasi)
                $item[3], // nama_kategori
            ];
        }
        return $normalizedData;
    }


    private function labelEncode(string $value): int
    {
        static $labels = [];
        if (!isset($labels[$value])) {
            $labels[$value] = count($labels) + 1;
        }
        return $labels[$value];
    }

    private function hierarchicalClustering(array $data, int $max_clusters = 5)
    {
        $n = count($data);

        $clusters = [];

        for ($i = 0; $i < $n; $i++) {
            $clusters[$i] = [$i];
        }

        // Loop sampai jumlah klaster mencapai max_clusters
        while (count($clusters) > $max_clusters) {
            $min_distance = PHP_FLOAT_MAX;
            $cluster1 = -1;
            $cluster2 = -1;

            // Cari dua klaster terdekat
            foreach ($clusters as $i => $clusterA) {
                foreach ($clusters as $j => $clusterB) {
                    if ($i >= $j) continue; // Hindari perhitungan ganda

                    // Hitung jarak antar klaster (gunakan metode single linkage)
                    $distance = $this->calculateClusterDistance($clusterA, $clusterB, $data);

                    // Update jarak terdekat
                    if ($distance < $min_distance) {
                        $min_distance = $distance;
                        $cluster1 = $i;
                        $cluster2 = $j;
                    }
                }
            }
            // Gabungkan dua klaster terdekat
            $clusters[$cluster1] = array_merge($clusters[$cluster1], $clusters[$cluster2]);
            // dd($clusters[$cluster2]);
            unset($clusters[$cluster2]);
        }
        // Kembalikan hasil klaster
        return $clusters;
    }

    private function calculateClusterDistance(array $clusterA, array $clusterB, array $data): float
    {
        $max_distance = 0;

        // Cari jarak terjauh antara dua titik di klaster A dan B
        foreach ($clusterA as $pointA) {
            foreach ($clusterB as $pointB) {
                $distance = $this->euclideanDistance($data[$pointA], $data[$pointB]);
                if ($distance > $max_distance) {
                    $max_distance = $distance;
                }
            }
        }

        return $max_distance;
    }

    private function euclideanDistance(array $point1, array $point2): float
    {
        $sum = 0;
        for ($i = 0; $i < count($point1); $i++) {
            $sum += pow($point1[$i] - $point2[$i], 2);
        }
        // dd(sqrt($sum));
        return sqrt($sum);
    }

    public function hasilClustering()
    {
        // Ambil data buku beserta klaster-nya
        $hasil = Buku::with(['kategori', 'kelompok'])->get();

        $groupedData = [];
        foreach ($hasil as $buku) {
            $label_klaster = $buku->kelompok ? $buku->kelompok->nama_kelompok : 'Tidak Terklaster';
            $groupedData[$label_klaster][] = $buku;
        }
        // dd($groupedData);

        // dd($groupedData);

        // return response()->json($hasil, 200);
        return view('pages.clustering.result', [
            'groupedData' => $groupedData
        ]);
    }
}
