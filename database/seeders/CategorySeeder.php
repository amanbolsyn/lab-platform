<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $electronicCategories = [
            "Microcontrollers",
            "Voltage Regulators",
            "Op-Amps",
            "Motor Drivers",
            "MOSFETs",
            "Transistors",
            "Diodes",
            "LEDs",
            "LCD Displays",
            "Photodetectors",
            "Fixed Resistors",
            "Potentiometers",
            "Thermistors",
            "Electrolytic Capacitors",
            "Ceramic Capacitors",
            "Tantalum Capacitors",
            "Power Inductors",
            "Ferrite Beads",
            "Transformers",
            "USB-C Connectors",
            "HDMI Sockets",
            "PCB Headers",
            "DC Jacks",
            "Printed Circuit Boards (PCB)",
            "Breadboards",
            "Jumper Wires",
            "Relays",
            "Switches",
            "Cooling Fans",
            "IMU (Motion Sensors)",
            "Biometric Sensors",
            "Environmental Sensors",
            "Ultrasonic Sensors"
        ];

        foreach ($electronicCategories as $category)
            Category::create([
                "category" => $category
            ]);
    }
}
