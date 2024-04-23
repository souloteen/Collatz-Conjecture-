class CollatzCalculator {
    public function calculateIterations($x) {
        $count = 0;
        while ($x != 1) {
            if ($x % 2 == 0) {
                $x /= 2;
            } else {
                $x = 3 * $x + 1;
            }
            $count++;
        }
        return $count;
    }
}

class RangeAnalyzer {
    private $collatzCalculator;

    public function __construct() {
        $this->collatzCalculator = new CollatzCalculator();
    }

    public function calculateMaxAndMinValues($start, $end) {
        $maxValue = 0;
        $minValue = PHP_INT_MAX;
        $maxNumbers = [];
        $minNumbers = [];
        $totalIterations = 0;

        for ($i = $start; $i <= $end; $i++) {
            $currentIterations = $this->collatzCalculator->calculateIterations($i);
            $totalIterations += $currentIterations;

            if ($currentIterations > $maxValue) {
                $maxValue = $currentIterations;
                $maxNumbers = [$i];
            } elseif ($currentIterations == $maxValue) {
                $maxNumbers[] = $i;
            }

            if ($currentIterations < $minValue) {
                $minValue = $currentIterations;
                $minNumbers = [$i];
            } elseif ($currentIterations == $minValue) {
                $minNumbers[] = $i;
            }
        }

        return [
            'max_value' => $maxValue,
            'max_numbers' => $maxNumbers,
            'min_value' => $minValue,
            'min_numbers' => $minNumbers,
            'total_iterations' => $totalIterations
        ];
    }

    protected function mathematicProgression($start, $end, $step) {
        $sequence = [];
        for ($i = $start; $i <= $end; $i += $step) {
            $sequence[] = $i;
        }
        return $sequence;
    }
}

class ExtendedRangeAnalyzer extends RangeAnalyzer {
    public function calculateStatistics($start, $end) {
        $data = $this->calculateMaxAndMinValues($start, $end);
        
        $averageIterations = $data['total_iterations'] / ($end - $start + 1);
        
        return [
            'max_value' => $data['max_value'],
            'max_numbers' => $data['max_numbers'],
            'min_value' => $data['min_value'],
            'min_numbers' => $data['min_numbers'],
            'total_iterations' => $data['total_iterations'],
            'average_iterations' => $averageIterations
        ];
    }
}

// Example usage:
$extendedAnalyzer = new ExtendedRangeAnalyzer();
$statistics = $extendedAnalyzer->calculateStatistics(1, 100);
print_r($statistics);
