<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::insert([

            [
                'title' => 'Full Body Health Checkup',
                'description' => 'A comprehensive diagnostic package covering essential health parameters including blood tests, vital checks, and overall health evaluation to ensure early detection and prevention.',
                'price' => 1000,
                'image' => 'uploads/images/service-page/S3.png',
                'instructions' => json_encode([
                    'Fasting required for 8–10 hours',
                    'Avoid fatty food before test',
                    'Drink normal water (allowed)',
                    'Avoid alcohol & smoking 24 hours before',
                    'Bring previous reports if available'
                ]),
            ],

            [
                'title' => 'X-Ray Scan',
                'description' => 'Digital X-ray imaging for bone, chest, and internal structure diagnosis with high accuracy.',
                'price' => 1500,
                'image' => 'uploads/images/service-page/S6.png',
                'instructions' => json_encode([
                    'Remove metal objects before test',
                    'Wear comfortable clothing',
                    'Inform technician if pregnant',
                    'Follow radiologist instructions'
                ]),
            ],

            [
                'title' => 'Blood Pressure Check',
                'description' => 'Quick and accurate blood pressure monitoring to assess heart health and hypertension risk.',
                'price' => 800,
                'image' => 'uploads/images/service-page/S4.png',
                'instructions' => json_encode([
                    'Avoid caffeine 30 minutes before',
                    'Sit and relax before test',
                    'No smoking before test',
                    'Wear loose clothing'
                ]),
            ],

            [
                'title' => 'Blood Sugar Test',
                'description' => 'Measures glucose level in blood to diagnose diabetes and monitor sugar control.',
                'price' => 500,
                'image' => 'uploads/images/service-page/S1.png',
                'instructions' => json_encode([
                    'Fasting required 8–12 hours',
                    'Avoid sweets before test',
                    'Inform if on medication',
                    'Only water allowed'
                ]),
            ],

            [
                'title' => 'Full Blood Count (CBC)',
                'description' => ' Comprehensive blood analysis to check infection, anemia, and overall health condition.',
                'price' => 600,
                'image' => 'uploads/images/service-page/S2.png',
                'instructions' => json_encode([
                    'No fasting required',
                    'Avoid heavy exercise before test',
                    'Bring previous reports if available',
                    'Stay hydrated'
                ]),
            ],

        ]);
    }
}
