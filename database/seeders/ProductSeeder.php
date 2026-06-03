<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Carbon Fiber Rear Spoiler for Audi RS6',
                'price' => 1200,
                'old_price' => 1400,
                'category' => 'Exterior Accessories',
                'image' => 'https://images.unsplash.com/photo-1603584173870-7f23fdae1b7a?auto=format&fit=crop&q=80&w=1000',
                'description' => 'Enhance the aerodynamics and aggressive look of your Audi RS6 with this premium dry carbon fiber rear spoiler. Lightweight and incredibly strong, it offers a perfect fit and stunning glossy finish.',
                'brand' => 'AeroTech',
                'stock' => 15,
                'status' => 'active',
                'featured' => true,
            ],
            [
                'name' => 'Brembo Performance Brake Calipers (Set)',
                'price' => 850,
                'old_price' => 950,
                'category' => 'Performance Parts',
                'image' => 'https://images.unsplash.com/photo-1590432851457-36e2f6a7d5ea?auto=format&fit=crop&q=80&w=1000',
                'description' => 'Upgrade your stopping power with Brembo High-Performance 6-piston brake calipers. Finished in signature red with white lettering. Engineered for track days and intense street driving.',
                'brand' => 'Brembo',
                'stock' => 8,
                'status' => 'active',
                'featured' => true,
            ],
            [
                'name' => 'Akrapovič Titanium Exhaust System',
                'price' => 3500,
                'old_price' => 3800,
                'category' => 'Performance Parts',
                'image' => 'https://images.unsplash.com/photo-1543881477-9372bd1643c5?auto=format&fit=crop&q=80&w=1000',
                'description' => 'Unleash the true sound of your V8 engine. Made entirely from ultra-lightweight titanium, this system reduces weight by 12kg and adds 15hp while providing a deep, aggressive exhaust note.',
                'brand' => 'Akrapovič',
                'stock' => 5,
                'status' => 'active',
                'featured' => true,
            ],
            [
                'name' => 'Forged Alloy Wheels 21" (Set of 4)',
                'price' => 2400,
                'old_price' => 2800,
                'category' => 'Exterior Accessories',
                'image' => 'https://images.unsplash.com/photo-1580274455046-e57929424841?auto=format&fit=crop&q=80&w=1000',
                'description' => 'Satin black 21-inch forged alloy wheels. Specifically milled for optimal weight reduction and structural integrity. Enhances handling and provides an aggressive stance.',
                'brand' => 'Vossen',
                'stock' => 12,
                'status' => 'active',
                'featured' => true,
            ],
            [
                'name' => 'Premium Alcantara Steering Wheel Cover',
                'price' => 150,
                'old_price' => null,
                'category' => 'Interior Accessories',
                'image' => 'https://images.unsplash.com/photo-1600706432502-77a0e2e32770?auto=format&fit=crop&q=80&w=1000',
                'description' => 'Hand-stitched genuine Italian Alcantara steering wheel cover. Provides superior grip during high-speed driving, stays cool in summer, and adds a luxurious motorsport feel to your cabin.',
                'brand' => 'Sparco',
                'stock' => 30,
                'status' => 'active',
                'featured' => false,
            ],
            [
                'name' => 'High-Performance Cold Air Intake Kit',
                'price' => 450,
                'old_price' => 500,
                'category' => 'Performance Parts',
                'image' => 'https://images.unsplash.com/photo-1620023805400-f7253b218cd0?auto=format&fit=crop&q=80&w=1000',
                'description' => 'Maximize airflow and throttle response. This carbon-fiber housed cold air intake kit significantly lowers intake temperatures, yielding an immediate horsepower increase of up to 12hp.',
                'brand' => 'K&N',
                'stock' => 20,
                'status' => 'active',
                'featured' => false,
            ]
        ];

        foreach ($products as $data) {
            Product::firstOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}
