<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        Doctor::create([
            'name' => 'Dr. Masud Khan',
            'speciality' => 'Cardiologist',
            'image' => 'uploads/images/doctor-page/D2.png',
            'success_rate' => 90,
            'experience_years' => 7,
            'total_patients' => '2K+',
            'qualification' => 'MBBS, MD (Cardiology)',
            'location' => 'Dhaka Medical College',
            'consultation_fee' => 1000,
            'availability' => 'Available',
            'about' => 'Dr. Masud Khan is a highly experienced cardiologist in Bangladesh with a strong track record of treating heart diseases. He has successfully treated thousands of patients and specializes in modern cardiac care and diagnostic.',
        ]);

        Doctor::create([
            'name' => 'Dr. Farhana Rahman',
            'speciality' => 'Dermatologist',
            'image' => 'uploads/images/doctor-page/D1.png',
            'success_rate' => 95,
            'experience_years' => 8,
            'total_patients' => '3K+',
            'qualification' => 'MBBS, DDV',
            'location' => 'Square Hospital',
            'consultation_fee' => 800,
            'availability' => 'Available',
            'about' => 'Dr. Farhana Rahman is a skilled dermatologist in Bangladesh with extensive experience in treating skin, hair, and nail conditions. She is known for her patient-friendly approach and expertise in advanced dermatological procedures, including acne treatment, laser therapy, and cosmetic skin care.',
        ]);

        Doctor::create([
            'name' => 'Dr. Tanvir Ahmed',
            'speciality' => 'Neurologist',
            'image' => 'uploads/images/doctor-page/D4.png',
            'success_rate' => 92,
            'experience_years' => 12,
            'total_patients' => '4K+',
            'qualification' => 'MBBS, FCPS (Neurology)',
            'location' => 'United Hospital, Dhaka',
            'consultation_fee' => 1200,
            'availability' => 'Available',
            'about' => 'Dr. Tanvir Ahmed is a highly skilled neurologist specializing in brain and nervous system disorders. With over a decade of experience, he has successfully treated patients with stroke, epilepsy, and migraine. He is known for his accurate diagnosis and patient-centered care approach.',
        ]);

        Doctor::create([
            'name' => 'Dr. Nusrat Jahan',
            'speciality' => 'Gynecologist',
            'image' => 'uploads/images/doctor-page/D3.png',
            'success_rate' => 94,
            'experience_years' => 9,
            'total_patients' => '3.5K+',
            'qualification' => 'MBBS, FCPS (Gynecology)',
            'location' => 'Apollo Hospital, Dhaka',
            'consultation_fee' => 900,
            'availability' => 'Available',
            'about' => 'Dr. Nusrat Jahan is an experienced gynecologist providing expert care in women’s health, pregnancy, and reproductive medicine. She is widely respected for her compassionate approach and commitment to ensuring safe and comfortable treatment for her patients.',
        ]);

        Doctor::create([
            'name' => 'Dr. Shafiqur Rahman',
            'speciality' => 'Orthopedic Surgeon',
            'image' => 'uploads/images/doctor-page/D6.png',
            'success_rate' => 96,
            'experience_years' => 15,
            'total_patients' => '5K+',
            'qualification' => 'MBBS, MS (Orthopedics)',
            'location' => 'Square Hospital, Dhaka',
            'consultation_fee' => 1500,
            'availability' => 'Available',
            'about' => 'Dr. Shafiqur Rahman is a senior orthopedic surgeon with extensive experience in bone, joint, and trauma care. He specializes in fracture management, joint replacement, and sports injuries, delivering high-quality surgical outcomes.',
        ]);

        Doctor::create([
            'name' => 'Dr. Ayesha Sultana',
            'speciality' => 'Pediatrician',
            'image' => 'uploads/images/doctor-page/D5.png',
            'success_rate' => 93,
            'experience_years' => 7,
            'total_patients' => '2.8K+',
            'qualification' => 'MBBS, DCH (Child Health)',
            'location' => 'Dhaka Shishu Hospital',
            'consultation_fee' => 700,
            'availability' => 'Available',
            'about' => 'Dr. Ayesha Sultana is a dedicated pediatrician specializing in child healthcare, nutrition, and development. She is known for her friendly interaction with children and her ability to handle complex pediatric cases with care and precision.',
        ]);

        Doctor::create([
            'name' => 'Dr. Imran Hossain',
            'speciality' => 'ENT Specialist',
            'image' => 'uploads/images/doctor-page/D7.png',
            'success_rate' => 91,
            'experience_years' => 11,
            'total_patients' => '3K+',
            'qualification' => 'MBBS, DLO (ENT)',
            'location' => 'Labaid Hospital, Dhaka',
            'consultation_fee' => 850,
            'availability' => 'Available',
            'about' => 'Dr. Imran Hossain is an experienced ENT specialist focusing on ear, nose, and throat conditions. He provides advanced treatments for sinus issues, hearing problems, and throat infections with modern medical techniques.',
        ]);
    }
}
