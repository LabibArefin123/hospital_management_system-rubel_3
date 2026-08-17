<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $contacts = [

            [
                'name' => 'Md. Rakib Hasan',
                'email' => 'rakib@gmail.com',
                'phone' => '01711223344',
                'department' => 'Cardiology',
                'service' => 'Consultation',
                'message' => 'Chest pain issue for the last 2 days. Need urgent appointment.',
            ],

            [
                'name' => 'Nusrat Jahan',
                'email' => 'nusrat@gmail.com',
                'phone' => '01844556677',
                'department' => 'Dermatology',
                'service' => 'Checkup',
                'message' => 'Skin allergy and itching problem after using cosmetics.',
            ],

            [
                'name' => 'Mohammad Faisal',
                'email' => 'faisal@gmail.com',
                'phone' => '01922334455',
                'department' => 'Neurology',
                'service' => 'Consultation',
                'message' => 'Frequent headache and dizziness for one week.',
            ],

            [
                'name' => 'Farzana Akter',
                'email' => 'farzana@gmail.com',
                'phone' => '01677889900',
                'department' => 'Gynecology',
                'service' => 'Emergency',
                'message' => 'Need emergency support regarding pregnancy complications.',
            ],

            [
                'name' => 'Kamrul Islam',
                'email' => 'kamrul@gmail.com',
                'phone' => '01555667788',
                'department' => 'Cardiology',
                'service' => 'Checkup',
                'message' => 'Want to do ECG and heart checkup.',
            ],

            [
                'name' => 'Sadia Rahman',
                'email' => 'sadia@gmail.com',
                'phone' => '01399887766',
                'department' => 'Dermatology',
                'service' => 'Consultation',
                'message' => 'Acne and skin pigmentation problem.',
            ],

        ];

        foreach ($contacts as $contact) {

            Contact::create($contact);
        }
    }
}
