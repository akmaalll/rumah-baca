<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\ClusterBuku;
use App\Models\Clustering;
use Illuminate\Http\Request;

class ClusteringController extends Controller
{
    public function index()
    {
        $menu = 'clustering';
        $prosesHistory = Clustering::with('admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.clustering.index', compact('prosesHistory', 'menu'));
    }

    public function process(Request $request)
    {
        // Validasi input
        $request->validate([
            'jumlah_cluster' => 'required|integer|min:2',
        ]);

        // Ambil semua data buku
        $books = Buku::all();

        // Proses clustering
        $clusters = $this->performClustering($books, $request->jumlah_cluster);

        // Simpan hasil clustering
        $this->saveClusteringResults($clusters);

        // Catat proses clustering
        Clustering::create([
            'user_id' => 1,
            'jumlah_cluster' => $request->jumlah_cluster,
            'status' => 'completed',
            'catatan' => 'Clustering berhasil dilakukan'
        ]);

        return redirect()->route('clustering.index')
            ->with('success', 'Proses clustering berhasil dilakukan');
    }

    private function performClustering($books, $numClusters)
    {
        // Siapkan data untuk clustering
        $data = [];
        foreach ($books as $book) {
            // Konversi data buku menjadi vektor fitur
            $features = $this->extractFeatures($book);
            $data[] = [
                'book_id' => $book->id,
                'features' => $features
            ];
        }

        // Implementasi Hierarchical Clustering
        $clusters = $this->hierarchicalClustering($data, $numClusters);

        return $clusters;
    }

    private function extractFeatures($book)
    {
        // Ekstrak fitur dari buku
        $features = [];

        // 1. Kategori sebagai one-hot encoding
        $categories = $book->kategori->pluck('id')->toArray();
        // 2. Tag sebagai bag of words
        $tags = explode(',', $book->tag);
        // 3. Tahun terbit dinormalisasi
        $yearNormalized = ($book->tahun_terbit - 1900) / (2024 - 1900);

        return array_merge($features, [
            'categories' => $categories,
            'tags' => $tags,
            'year' => $yearNormalized
        ]);
    }

    private function hierarchicalClustering($data, $numClusters)
    {
        // Inisialisasi: setiap item dalam cluster sendiri
        $clusters = [];
        foreach ($data as $index => $item) {
            $clusters[] = [$index];
        }

        // Hitung matrix jarak
        $distances = [];
        for ($i = 0; $i < count($data); $i++) {
            for ($j = $i + 1; $j < count($data); $j++) {
                $distances[$i][$j] = $this->calculateDistance(
                    $data[$i]['features'],
                    $data[$j]['features']
                );
                $distances[$j][$i] = $distances[$i][$j];
            }
        }

        // Proses merging cluster hingga mencapai jumlah cluster yang diinginkan
        while (count($clusters) > $numClusters) {
            // Cari dua cluster terdekat
            $minDistance = PHP_FLOAT_MAX;
            $merge = [-1, -1];

            for ($i = 0; $i < count($clusters); $i++) {
                for ($j = $i + 1; $j < count($clusters); $j++) {
                    $dist = $this->calculateClusterDistance(
                        $clusters[$i],
                        $clusters[$j],
                        $distances
                    );
                    if ($dist < $minDistance) {
                        $minDistance = $dist;
                        $merge = [$i, $j];
                    }
                }
            }

            // Gabungkan dua cluster terdekat
            $newCluster = array_merge(
                $clusters[$merge[0]],
                $clusters[$merge[1]]
            );

            // Hapus cluster lama dan tambahkan cluster baru
            unset($clusters[$merge[1]]);
            $clusters[$merge[0]] = $newCluster;
            $clusters = array_values($clusters);
        }

        return $clusters;
    }

    private function calculateDistance($features1, $features2)
    {
        $distance = 0;

        // Hitung jarak untuk kategori (Jaccard distance)
        $intersection = count(array_intersect($features1['categories'], $features2['categories']));
        $union = count(array_unique(array_merge($features1['categories'], $features2['categories'])));
        $categoryDistance = $union > 0 ? 1 - ($intersection / $union) : 1;

        // Hitung jarak untuk tag (Jaccard distance)
        $intersection = count(array_intersect($features1['tags'], $features2['tags']));
        $union = count(array_unique(array_merge($features1['tags'], $features2['tags'])));
        $tagDistance = $union > 0 ? 1 - ($intersection / $union) : 1;

        // Hitung jarak untuk tahun (Euclidean distance)
        $yearDistance = abs($features1['year'] - $features2['year']);

        // Gabungkan semua jarak dengan bobot
        $distance = (0.4 * $categoryDistance) + (0.4 * $tagDistance) + (0.2 * $yearDistance);

        return $distance;
    }

    private function calculateClusterDistance($cluster1, $cluster2, $distances)
    {
        // Implementasi average linkage
        $totalDistance = 0;
        $count = 0;

        foreach ($cluster1 as $i) {
            foreach ($cluster2 as $j) {
                $totalDistance += $distances[$i][$j];
                $count++;
            }
        }

        return $count > 0 ? $totalDistance / $count : PHP_FLOAT_MAX;
    }

    private function saveClusteringResults($clusters)
    {
        // Hapus hasil clustering sebelumnya
        ClusterBuku::truncate();

        $namaKelompok = [
            'Teknologi dan Inovasi',
            'Fiksi Modern',
            'Pengembangan Diri',
            'Sejarah dan Budaya',
            'Fantasi dan Petualangan'
        ];

        // Simpan hasil clustering baru
        foreach ($clusters as $clusterIndex => $cluster) {
            foreach ($cluster as $bookIndex) {
                ClusterBuku::create([
                    'buku_id' => $bookIndex + 1, // Sesuaikan dengan ID buku
                    'level_kelompok' => 1,
                    'nama_kelompok' => $namaKelompok[$clusterIndex] ?? 'Cluster ' . ($clusterIndex + 1)
                ]);
            }
        }
    }

    public function showResults($clusteringId)
    {
        // Ambil data clustering
        $menu = 'clustering';
        $clustering = Clustering::findOrFail($clusteringId);
        // dd($clustering['status']);

        // Ambil hasil cluster
        $clusterResults = ClusterBuku::with('buku')
            ->get()
            ->groupBy('nama_kelompok');
        // dd($clusterResults);

        return view('pages.clustering.result', compact('clustering', 'clusterResults', 'menu'));
    }
}
