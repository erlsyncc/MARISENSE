<?php

namespace App\Controllers;

use App\Models\BuoyDataModel;

class Home extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $activityOrder = ['Jet Ski', 'Banana Boat', 'Kayaking', 'Flying Saucer'];
        $activityRows = $db->table('activities')
                           ->select('name, price, price_type, status')
                           ->whereIn('name', $activityOrder)
                           ->where('status', 'active')
                           ->get()
                           ->getResultArray();

        $activityMap = [];
        foreach ($activityRows as $row) {
            $activityMap[$row['name']] = $row;
        }

        $featuredActivities = [];
        foreach ($activityOrder as $name) {
            if (isset($activityMap[$name])) {
                $featuredActivities[] = $activityMap[$name];
            }
        }

        $buoyModel = new BuoyDataModel();
        $buoyData  = $buoyModel->getLatestReading();
        $seaSnapshot = null;

        if ($buoyData) {
            $waveHeight = (float) ($buoyData['avg_wave_height'] ?? 0.0);
            $windSpeed  = (float) ($buoyData['avg_wind_speed'] ?? 0.0);
            $waterTemp  = $buoyData['water_temp_avg'] ?? null;

            $statusClass = 'sea-safe';
            $statusLabel = 'Safe for activities';
            $statusNote   = 'Waves and wind are within the normal operating range.';

            if ($waveHeight > 1.2 || $windSpeed > 20.0) {
                $statusClass = 'sea-unsafe';
                $statusLabel = 'Not recommended';
                $statusNote   = 'Conditions are above safe thresholds.';
            } elseif (($waveHeight >= 0.6 && $waveHeight <= 1.2) || ($windSpeed >= 10.0 && $windSpeed <= 20.0)) {
                $statusClass = 'sea-moderate';
                $statusLabel = 'Use caution';
                $statusNote   = 'Conditions are manageable, but please stay alert.';
            }

            $seaSnapshot = [
                'class'   => $statusClass,
                'label'   => $statusLabel,
                'note'    => $statusNote,
                'wind'    => number_format($windSpeed, 1) . ' m/s',
                'wave'    => number_format($waveHeight, 2) . ' m',
                'temp'    => $waterTemp === null ? 'N/A' : number_format((float) $waterTemp, 1) . ' °C',
                'updated' => $buoyData['recorded_at'] ? date('M d, Y h:i A', strtotime($buoyData['recorded_at'])) : 'N/A',
            ];
        }

        $data['apiKey'] = "YOUR_GOOGLE_MAPS_API_KEY";
        $data['featuredActivities'] = $featuredActivities;
        $data['seaSnapshot'] = $seaSnapshot;

        return view('landing', $data);
    }
}
