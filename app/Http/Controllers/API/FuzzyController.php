<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\FuzzyCommon;


class FuzzyController extends Controller
{
    public function fuzzyHandle(Request $request) {
        $data = $request->all();

        $population = $data['population'] ?? "";
        $gdp = $data['gdp'] ?? "";
        $gdp_per_capita = $data['gdp_per_capita'] ?? "";
        $unemployment_rate = $data['unemployment_rate'] ?? "";

        // lấy thông tin nhãn và giá trị miu của từng chỉ số
        $populationInfo = $this->getPopulationLabel($population);
        $gdpInfo = $this->getGDPLabel($gdp);
        $gdpPerCapitaInfo = $this->getGDPPerCapitaLabel($gdp_per_capita);
        $unemploymentRateInfo = $this->getUnemploymentRateLabel($unemployment_rate);

        $economicLabel = $this->evaluatingEconomicLevel($populationInfo["label"], $gdpInfo["label"], $gdpPerCapitaInfo["label"], $unemploymentRateInfo["label"]);
        $resultValue = min($populationInfo["value"], $gdpInfo["value"], $gdpPerCapitaInfo["value"], $unemploymentRateInfo["value"]);

        $economicValue = $this->getEconomicValue($resultValue, $economicLabel);
        return response()->json([
            'status' => "success",
            "economy" => ["label" => $economicLabel, "value" => $economicValue],
            "population" => $populationInfo,
            "gdp" => $gdpInfo,
            "gdp_per_capita" => $gdpPerCapitaInfo,
            "unemployment_rate" => $unemploymentRateInfo,
        ]);
    }

    public function getPopulationLabel($x) {
        if ($x <= 0) {
            return ["label" => "SP", "value" => 1];
        } else if ($x <= 20) {
            $SPValue = (50 - $x)/50;
            $MPValue = $x/20;
            $LPValue = $x/50;
        } else if ($x <= 30) {
            $SPValue = (50 - $x)/50;
            $MPValue = 1;
            $LPValue = $x/50;
        } else if ($x <= 50) {
            $SPValue = (50 - $x)/50;
            $MPValue = (50 - $x)/20;
            $LPValue = $x/50;
        } else {
            return ["label" => "LP", "value" => 1];
        }

        $result = max($SPValue, $MPValue, $LPValue);
        if ($result == $SPValue) {
            return ["label" => "SP", "value" => $result];
        } else if ($result == $MPValue) {
            return ["label" => "MP", "value" => $result];
        } else {
            return ["label" => "LP", "value" => $result];
        }
    }

    public function getGDPLabel($x) {
        if ($x <= 50000) {
            $VLValue = 1;
        } else if ($x <= 100000) {
            $VLValue = (1000000 - $x)/50000;
        } else {
            $VLValue = 0;
        }

        if ($x <= 0) {
            $LOValue = 0;
        } else if ($x <= 100000) {
            $LOValue = $x/100000;
        } else if ($x <= 200000) {
            $LOValue = (200000 - $x)/100000;
        } else {
            $LOValue = 0;
        }

        if ($x <= 100000) {
            $MEValue = 0;
        } else if ($x <= 200000) {
            $MEValue = ($x - 100000)/100000;
        } else if ($x <= 500000) {
            $MEValue = 1;
        } else if ($x <= 600000) {
            $MEValue = (600000 - $x)/100000;
        } else {
            $MEValue = 0;
        }

        if ($x <= 500000) {
            $HIValue = 0;
        } else if ($x <= 600000) {
            $HIValue = ($x - 500000)/100000;
        } else if ($x <= 900000) {
            $HIValue = 1;
        } else if ($x <= 1000000) {
            $HIValue = (1000000 - $x)/100000;
        } else {
            $HIValue = 0;
        }

        if ($x <= 900000) {
            $VHValue = 0;
        } else if ($x <= 1000000) {
            $VHValue = ($x - 900000)/100000;
        } else {
            $VHValue = 1;
        }

        $result = max($VLValue, $LOValue, $MEValue, $HIValue, $VHValue);
        if ($result == $VLValue) {
            return ["label" => "VL", "value" => $result];
        } else if ($result == $LOValue) {
            return ["label" => "LO", "value" => $result];
        } else if ($result == $MEValue) {
            return ["label" => "ME", "value" => $result];
        } else if ($result == $HIValue) {
            return ["label" => "HI", "value" => $result];
        } else {
            return ["label" => "VH", "value" => $result];
        }
    }

    public function getGDPPerCapitaLabel($x) {
        if ($x <= 0) {
            $LPCValue = 1;
        } else if ($x <= 30000) {
            $LPCValue = (30000 - $x)/30000;
        } else {
            $LPCValue = 0;
        }

        if ($x <= 0) {
            $MPCValue = 0;
        } else if ($x <= 15000) {
            $MPCValue = $x/15000;
        } else if ($x <= 30000) {
            $MPCValue = (30000 - $x)/30000;
        } else {
            $MPCValue = 0;
        }

        if ($x <= 0) {
            $HPCValue = 0;
        } else if ($x <= 30000) {
            $HPCValue = $x/30000;
        } else {
            $HPCValue = 1;
        }

        $result = max($LPCValue, $MPCValue, $HPCValue);
        if ($result == $LPCValue) {
            return ["label" => "LPC", "value" => $result];
        } else if ($result == $MPCValue) {
            return ["label" => "MPC", "value" => $result];
        } else {
            return ["label" => "HPC", "value" => $result];
        }
    }

    public function getUnemploymentRateLabel($x) {
        if ($x <= 0) {
            $LURValue = 1;
        } else if ($x <= 20) {
            $LURValue = (20 - $x)/20;
        } else {
            $LURValue = 0;
        }

        if ($x <= 0) {
            $MURValue = 0;
        } else if ($x <= 10) {
            $MURValue = $x/10;
        } else if ($x <= 20) {
            $MURValue = (20 - $x)/10;
        } else {
            $MURValue = 0;
        }

        if ($x <= 0) {
            $HURValue = 0;
        } else if ($x <= 20) {
            $HURValue = $x/20;
        } else {
            $HURValue = 1;
        }

        $result = max($LURValue, $MURValue, $HURValue);
        if ($result == $LURValue) {
            return ["label" => "LUR", "value" => $result];
        } else if ($result == $MURValue) {
            return ["label" => "MUR", "value" => $result];
        } else {
            return ["label" => "HUR", "value" => $result];
        }
    }

    public function getEconomicValue($resultValue, $resultLabel) {
        if ($resultLabel === "LOW") {
            return 10 - $resultValue * 10;
        }

        if ($resultLabel === "MEDIUM") {
            return (($resultValue * 5) + (10 - $resultValue * 5)) / 2;
        }

        if ($resultLabel === "HIGHT") {
            return $resultValue * 10;
        }

    }
    public function evaluatingEconomicLevel ($population, $gdp, $gdpPerCapita, $unemploymentRate) {

        // LOW
        foreach (FuzzyCommon::LOW_ECONOMY as $item) {
            $condPopulation = in_array($population, $item[0]);
            $condGDP = in_array($gdp, $item[1]);
            $condGDPPerCapita = in_array($gdpPerCapita, $item[2]);
            $condUnemploymentRate = in_array($unemploymentRate, $item[3]);
            if ($condPopulation && $condGDP && $condGDPPerCapita && $condUnemploymentRate) {
                return "LOW";
            }
        }

        // MEDIUM
        foreach (FuzzyCommon::MEDIUM_ECONOMY as $item) {
            $condPopulation = in_array($population, $item[0]);
            $condGDP = in_array($gdp, $item[1]);
            $condGDPPerCapita = in_array($gdpPerCapita, $item[2]);
            $condUnemploymentRate = in_array($unemploymentRate, $item[3]);
            if ($condPopulation && $condGDP && $condGDPPerCapita && $condUnemploymentRate) {
                return "MEDIUM";
            }
        }

        // HIGH
        foreach (FuzzyCommon::HIGH_ECONOMY as $item) {
            $condPopulation = in_array($population, $item[0]);
            $condGDP = in_array($gdp, $item[1]);
            $condGDPPerCapita = in_array($gdpPerCapita, $item[2]);
            $condUnemploymentRate = in_array($unemploymentRate, $item[3]);
            if ($condPopulation && $condGDP && $condGDPPerCapita && $condUnemploymentRate) {
                return "HIGH";
            }
        }

        return "";
    }
}
