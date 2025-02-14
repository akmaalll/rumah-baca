<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\ClusterBuku;
use Exception;

class ClusteringController extends Controller
{
    // Constants for clustering parameters
    private const MAX_CLUSTERS = 12;
    private const LINKAGE_METHODS = [
        'SINGLE' => 'single',
        'COMPLETE' => 'complete',
        'AVERAGE' => 'average'
    ];

    public function index()
    {
        return view('pages.clustering.index', [
            'menu' => 'clustering'
        ]);
    }

    public function clusterBuku()
    {
        $books = Buku::with('kategori')->get();

        if ($books->isEmpty()) {
            return response()->json([
                'message' => 'Data buku kosong'
            ], 404);
        }

        // Prepare features for clustering
        $features = $this->prepareFeatures($books);
        $normalizedFeatures = $this->normalizeFeatures($features);

        try {
            // Perform hierarchical clustering with complete linkage
            $clusters = $this->performHierarchicalClustering(
                $normalizedFeatures,
                self::MAX_CLUSTERS,
                self::LINKAGE_METHODS['SINGLE']
            );

            // Save clustering results
            $this->saveClusteringResults($clusters, $books);

            return redirect()->route('clustering.hasil')->with('success', 'Clustering berhasil dilakukan.');
        } catch (Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    private function prepareFeatures($books): array
    {
        $features = [];
        $labelEncoder = new LabelEncoder();

        foreach ($books as $book) {
            $features[] = [
                $labelEncoder->encode($book->kategori->nama_kategori),
                $labelEncoder->encode($book->kategori->sub_kategori)
            ];
        }

        return $features;
    }

    private function normalizeFeatures(array $features): array
    {
        return $features;
    }

    private function performHierarchicalClustering(array $data, int $maxClusters, string $linkageMethod): array
    {
        $n = count($data);
        $clusters = array_map(fn($i) => [$i], range(0, $n - 1));
        $distanceMatrix = $this->buildDistanceMatrix($data);

        while (count($clusters) > $maxClusters) {
            // Find closest clusters
            $closestPair = $this->findClosestClusters($clusters, $distanceMatrix, $linkageMethod);

            if (!$closestPair) {
                break;
            }

            [$cluster1, $cluster2] = $closestPair;

            // Merge clusters
            $clusters[$cluster1] = array_merge($clusters[$cluster1], $clusters[$cluster2]);
            unset($clusters[$cluster2]);
        }

        return $clusters;
    }

    private function buildDistanceMatrix(array $data): array
    {
        $n = count($data);
        $matrix = [];

        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($i != $j) {
                    $matrix[$i][$j] = $this->calculateEuclideanDistance($data[$i], $data[$j]);
                }
            }
        }

        return $matrix;
    }

    private function findClosestClusters(array $clusters, array $distanceMatrix, string $linkageMethod): ?array
    {
        $minDistance = PHP_FLOAT_MAX;
        $closestPair = null;

        foreach ($clusters as $i => $clusterA) {
            foreach ($clusters as $j => $clusterB) {
                if ($i >= $j) continue;

                $distance = $this->calculateClusterDistance(
                    $clusterA,
                    $clusterB,
                    $distanceMatrix,
                    $linkageMethod
                );

                if ($distance < $minDistance) {
                    $minDistance = $distance;
                    $closestPair = [$i, $j];
                }
            }
        }

        return $closestPair;
    }

    private function calculateClusterDistance(
        array $clusterA,
        array $clusterB,
        array $distanceMatrix,
        string $linkageMethod
    ): float {
        $distances = [];

        foreach ($clusterA as $pointA) {
            foreach ($clusterB as $pointB) {
                $distances[] = $distanceMatrix[$pointA][$pointB];
            }
        }

        switch ($linkageMethod) {
            case self::LINKAGE_METHODS['SINGLE']:
                return min($distances);
            case self::LINKAGE_METHODS['COMPLETE']:
                return max($distances);
            case self::LINKAGE_METHODS['AVERAGE']:
                return array_sum($distances) / count($distances);
            default:
                throw new Exception('Invalid linkage method');
        }
    }

    private function calculateEuclideanDistance(array $point1, array $point2): float
    {
        return sqrt(array_sum(array_map(
            fn($i) => pow($point1[$i] - $point2[$i], 2),
            array_keys($point1)
        )));
    }

    private function generateClusterName(array $indices, $books): string
    {
        $categories = [];
        $years = [];
        $size = count($indices);

        foreach ($indices as $index) {
            $book = $books[$index];
            $categories[$book->kategori->nama_kategori] = true;
            $years[$book->tahun_terbit] = true;
        }

        $categoryNames = array_keys($categories);
        $yearRange = $this->formatYearRange(array_keys($years));

        return sprintf(
            'Klaster %s (%d buku) - %s',
            implode(', ', $categoryNames),
            $size,
            $yearRange
        );
    }

    private function formatYearRange(array $years): string
    {
        sort($years);
        $minYear = reset($years);
        $maxYear = end($years);

        return $minYear === $maxYear
            ? "Tahun $minYear"
            : "Tahun $minYear-$maxYear";
    }

    private function saveClusteringResults(array $clusters, $books): void
    {
        ClusterBuku::truncate();

        foreach ($clusters as $clusterIndices) {
            $clusterName = $this->generateClusterName($clusterIndices, $books);

            foreach ($clusterIndices as $index) {
                ClusterBuku::create([
                    'buku_id' => $books[$index]->id,
                    'nama_kelompok' => $clusterName
                ]);
            }
        }
    }

    public function hasilClustering()
    {
        $books = Buku::with(['kategori', 'kelompok'])->get();

        $groupedData = $books->groupBy(function ($book) {
            return $book->kelompok?->nama_kelompok ?? 'Tidak Terklaster';
        });
        // dd($groupedData);

        return view('pages.clustering.result', [
            'groupedData' => $groupedData,
            'menu' => 'clustering'
        ]);
    }
}

class LabelEncoder
{
    private $labels = [];

    public function encode(string $value): int
    {
        if (!isset($this->labels[$value])) {
            $this->labels[$value] = count($this->labels) + 1;
        }
        return $this->labels[$value];
    }
}
