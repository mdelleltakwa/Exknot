<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Categories
        $categories = [
            ['name' => 'Strategy Consulting',   'slug' => 'strategy-consulting'],
            ['name' => 'Financial Audit',        'slug' => 'financial-audit'],
            ['name' => 'Technical Inspection',   'slug' => 'technical-inspection'],
            ['name' => 'Legal & Compliance',     'slug' => 'legal-compliance'],
            ['name' => 'IT & Cybersecurity',     'slug' => 'it-cybersecurity'],
            ['name' => 'HR & Training',          'slug' => 'hr-training'],
        ];
        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Admin user
        $admin = User::create([
            'name'              => 'Admin Exknot',
            'email'             => 'admin@exknot.com',
            'password'          => Hash::make('password'),
            'role'              => 'admin',
            'email_verified_at' => now(),
        ]);

        // Firm users
        $firm1 = User::create([
            'name'              => 'Alvarez & Mercer LLP',
            'email'             => 'contact@alvarez-mercer.com',
            'password'          => Hash::make('password'),
            'role'              => 'firm',
            'company_name'      => 'Alvarez & Mercer LLP',
            'country'           => 'United Kingdom',
            'bio'               => 'Leading strategy and M&A advisory firm based in London with 20+ years of experience across Europe and MENA.',
            'email_verified_at' => now(),
        ]);

        $firm2 = User::create([
            'name'              => 'Nexora Audit Group',
            'email'             => 'info@nexora-audit.com',
            'password'          => Hash::make('password'),
            'role'              => 'firm',
            'company_name'      => 'Nexora Audit Group',
            'country'           => 'Germany',
            'bio'               => 'Certified financial audit and ISO compliance specialists operating across 30+ European markets.',
            'email_verified_at' => now(),
        ]);

        $firm3 = User::create([
            'name'              => 'TechProbe Inspection',
            'email'             => 'ops@techprobe.ae',
            'password'          => Hash::make('password'),
            'role'              => 'firm',
            'company_name'      => 'TechProbe Inspection',
            'country'           => 'UAE',
            'bio'               => 'Premier NDT and industrial inspection firm covering GCC, Africa and Southeast Asia.',
            'email_verified_at' => now(),
        ]);

        // Client users
        $client1 = User::create([
            'name'              => 'Sophie Dubois',
            'email'             => 'sophie@globalcorp.fr',
            'password'          => Hash::make('password'),
            'role'              => 'client',
            'company_name'      => 'GlobalCorp France',
            'country'           => 'France',
            'email_verified_at' => now(),
        ]);

        $client2 = User::create([
            'name'              => 'Omar Al-Rashidi',
            'email'             => 'omar@gulf-energy.com',
            'password'          => Hash::make('password'),
            'role'              => 'client',
            'company_name'      => 'Gulf Energy Holdings',
            'country'           => 'Bahrain',
            'email_verified_at' => now(),
        ]);

        // Products / Services
        $services = [
            [
                'user_id'     => $firm1->id,
                'category_id' => 1,
                'title'       => 'M&A Due Diligence — Full Scope',
                'description' => 'Comprehensive financial, legal and operational due diligence for acquisitions between €5M and €500M. Our team of 15+ senior advisors delivers a full report within 3 weeks.',
                'price'       => 24000,
            ],
            [
                'user_id'     => $firm1->id,
                'category_id' => 1,
                'title'       => 'Strategic Restructuring Advisory',
                'description' => 'End-to-end corporate restructuring: portfolio review, cost optimization, and go-forward strategy. Tailored for mid-market European businesses.',
                'price'       => 18500,
            ],
            [
                'user_id'     => $firm2->id,
                'category_id' => 2,
                'title'       => 'ISO 27001 Compliance Audit',
                'description' => 'Full gap analysis, remediation roadmap, and certification support for ISO 27001. Delivered by certified lead auditors.',
                'price'       => 8900,
            ],
            [
                'user_id'     => $firm2->id,
                'category_id' => 2,
                'title'       => 'IFRS Financial Audit — Annual',
                'description' => 'Independent statutory audit compliant with IFRS standards. Suitable for companies with revenues between €2M and €50M.',
                'price'       => 12000,
            ],
            [
                'user_id'     => $firm3->id,
                'category_id' => 3,
                'title'       => 'NDT Inspection — PAUT & TOFD',
                'description' => 'Advanced non-destructive testing using Phased Array Ultrasonic Testing and Time of Flight Diffraction. Fully certified inspectors.',
                'price'       => 6500,
            ],
            [
                'user_id'     => $firm3->id,
                'category_id' => 3,
                'title'       => 'Industrial Equipment Certification',
                'description' => 'Full lifecycle certification for offshore and industrial equipment. Compliant with API, ASME and ISO standards.',
                'price'       => 9200,
            ],
            [
                'user_id'     => $firm2->id,
                'category_id' => 4,
                'title'       => 'GDPR Compliance Assessment',
                'description' => 'Full data protection impact assessment, policy review, and GDPR readiness roadmap. Delivered within 10 business days.',
                'price'       => 4800,
            ],
            [
                'user_id'     => $firm1->id,
                'category_id' => 5,
                'title'       => 'Cybersecurity Risk Assessment',
                'description' => 'Penetration testing, vulnerability scanning, and risk report with prioritized remediation plan. Covers cloud and on-premise infrastructure.',
                'price'       => 7500,
            ],
        ];

        $createdProducts = [];
        foreach ($services as $service) {
            $createdProducts[] = Product::create($service);
        }

        // Orders
        $order1 = Order::create([
            'user_id' => $client1->id,
            'total'   => 24000,
            'status'  => 'validated',
        ]);
        OrderItem::create(['order_id' => $order1->id, 'product_id' => $createdProducts[0]->id, 'quantity' => 1, 'price' => 24000]);

        $order2 = Order::create([
            'user_id' => $client2->id,
            'total'   => 6500,
            'status'  => 'pending',
        ]);
        OrderItem::create(['order_id' => $order2->id, 'product_id' => $createdProducts[4]->id, 'quantity' => 1, 'price' => 6500]);

        $order3 = Order::create([
            'user_id' => $client1->id,
            'total'   => 8900,
            'status'  => 'validated',
        ]);
        OrderItem::create(['order_id' => $order3->id, 'product_id' => $createdProducts[2]->id, 'quantity' => 1, 'price' => 8900]);

        // Reviews
        Review::create(['user_id' => $client1->id, 'product_id' => $createdProducts[0]->id, 'rating' => 5, 'comment' => 'Exceptional work. The due diligence report was thorough and delivered on time. Highly recommended.']);
        Review::create(['user_id' => $client1->id, 'product_id' => $createdProducts[2]->id, 'rating' => 5, 'comment' => 'Professional team, clear communication throughout. We passed ISO 27001 on first attempt.']);
        Review::create(['user_id' => $client2->id, 'product_id' => $createdProducts[4]->id, 'rating' => 4, 'comment' => 'Very competent inspectors, great documentation. Minor delays but overall excellent service.']);
    }
}
