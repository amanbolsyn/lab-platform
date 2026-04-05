<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aituPrograms = [
            [
                "program" => "Software Engineering",
                "code" => "6B06102"
            ],
            [
                "program" => "Computer Science",
                "code" => "6B06101"
            ],
            [
                "program" => "Big Data Analysis",
                "code" => "6B06103"
            ],
            [
                "program" => "Mathematical and Computational Science",
                "code" => "6B06107"
            ],
            [
                "program" => "Cybersecurity",
                "code" => "6B06301"
            ],
            [
                "program" => "Smart Security Technologies",
                "code" => "6B06302"
            ],
            [
                "program" => "Industrial Internet of Things",
                "code" => "6B07101"
            ],
            [
                "program" => "Electronic Engineering",
                "code" => "6B07102"
            ],
            [
                "program" => "Smart Technologies",
                "code" => "6B06202"
            ],
            [
                "program" => "Digital Technologies in Nuclear Power Engineering",
                "code" => "6B07103"
            ],
            [
                "program" => "IT Management",
                "code" => "6B04101"
            ],
            [
                "program" => "IT Entrepreneurship",
                "code" => "6B04102"
            ],
            [
                "program" => "AI Business",
                "code" => "6B04103"
            ],
            [
                "program" => "Media Technologies",
                "code" => "6B06105"
            ],
            [
                "program" => "Digital Journalism",
                "code" => "6B03201"
            ],
            [
                "program" => "Digital Public Administration",
                "code" => "6B04104"
            ]
        ];


        foreach ($aituPrograms as $program) {
            Program::create([
                'program' => $program['program'],
                'code' => $program['code'],
            ]);
        }
    }
}
