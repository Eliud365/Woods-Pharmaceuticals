<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\Supplier;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Suppliers
        $suppliers = [
            ['name' => 'Medisel Kenya Ltd', 'contact_person' => 'John Kamau', 'phone' => '0722100200', 'email' => 'info@medisel.co.ke', 'address' => 'Industrial Area, Nairobi', 'county' => 'Nairobi', 'is_active' => true],
            ['name' => 'PharmaTrust EA', 'contact_person' => 'Grace Wanjiku', 'phone' => '0733200300', 'email' => 'grace@pharmatrust.co.ke', 'address' => 'Westlands, Nairobi', 'county' => 'Nairobi', 'is_active' => true],
            ['name' => 'Cosmos Limited', 'contact_person' => 'Peter Otieno', 'phone' => '0711300400', 'email' => 'cosmos@mail.com', 'address' => 'Mombasa Road, Nairobi', 'county' => 'Nairobi', 'is_active' => true],
            ['name' => 'Dawa Ltd Nairobi', 'contact_person' => 'Mary Njeri', 'phone' => '0712400500', 'email' => 'mary@dawald.co.ke', 'address' => 'Embakasi, Nairobi', 'county' => 'Nairobi', 'is_active' => true],
            ['name' => 'Beta Healthcare', 'contact_person' => 'Samuel Kiptoo', 'phone' => '0700500600', 'email' => 'samuel@betahealthcare.co.ke', 'address' => 'Ruaraka, Nairobi', 'county' => 'Nairobi', 'is_active' => false],
            ['name' => 'Universal Pharma Supplies', 'contact_person' => 'Lucy Achieng', 'phone' => '0701600700', 'email' => 'lucy@universalpharma.co.ke', 'address' => 'Thika Road, Nairobi', 'county' => 'Kiambu', 'is_active' => true],
            ['name' => 'Goodlife Distributors', 'contact_person' => 'Brian Mutuku', 'phone' => '0702700800', 'email' => 'brian@goodlifedist.co.ke', 'address' => 'Ngong Road, Nairobi', 'county' => 'Nairobi', 'is_active' => true],
            ['name' => 'Kenya Medical Supplies Authority', 'contact_person' => 'Esther Wambui', 'phone' => '0703800900', 'email' => 'esther@kemsa.go.ke', 'address' => 'Commercial Street, Nairobi', 'county' => 'Nairobi', 'is_active' => true],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }

        // Medicines (30 items)
        $medicines = [
            ['name' => 'Paracetamol 500mg', 'generic_name' => 'Acetaminophen', 'category' => 'Analgesic', 'supplier' => 'Cosmos Limited', 'quantity' => 135, 'reorder_level' => 30, 'buying_price' => 50, 'selling_price' => 100, 'expiry_date' => now()->addMonths(18), 'batch_number' => 'BATCH001'],
            ['name' => 'Amoxicillin 500mg', 'generic_name' => 'Amoxicillin', 'category' => 'Antibiotic', 'supplier' => 'Medisel Kenya Ltd', 'quantity' => 8, 'reorder_level' => 20, 'buying_price' => 200, 'selling_price' => 300, 'expiry_date' => now()->addMonths(8), 'batch_number' => 'BATCH002'],
            ['name' => 'Ibuprofen 400mg', 'generic_name' => 'Ibuprofen', 'category' => 'Analgesic', 'supplier' => 'Cosmos Limited', 'quantity' => 150, 'reorder_level' => 30, 'buying_price' => 60, 'selling_price' => 90, 'expiry_date' => now()->addMonths(18), 'batch_number' => 'BATCH003'],
            ['name' => 'Vitamin C 1000mg', 'generic_name' => 'Ascorbic Acid', 'category' => 'Vitamin', 'supplier' => 'PharmaTrust EA', 'quantity' => 200, 'reorder_level' => 40, 'buying_price' => 80, 'selling_price' => 120, 'expiry_date' => now()->addMonths(24), 'batch_number' => 'BATCH004'],
            ['name' => 'Metformin 500mg', 'generic_name' => 'Metformin HCl', 'category' => 'Antidiabetic', 'supplier' => 'Dawa Ltd Nairobi', 'quantity' => 5, 'reorder_level' => 15, 'buying_price' => 120, 'selling_price' => 170, 'expiry_date' => now()->addDays(20), 'batch_number' => 'BATCH005'],
            ['name' => 'Cetirizine 10mg', 'generic_name' => 'Cetirizine HCl', 'category' => 'Antihistamine', 'supplier' => 'Medisel Kenya Ltd', 'quantity' => 90, 'reorder_level' => 25, 'buying_price' => 40, 'selling_price' => 70, 'expiry_date' => now()->addMonths(12), 'batch_number' => 'BATCH006'],
            ['name' => 'Omeprazole 20mg', 'generic_name' => 'Omeprazole', 'category' => 'Antacid', 'supplier' => 'PharmaTrust EA', 'quantity' => 60, 'reorder_level' => 20, 'buying_price' => 90, 'selling_price' => 140, 'expiry_date' => now()->addMonths(15), 'batch_number' => 'BATCH007'],
            ['name' => 'Diclofenac Gel', 'generic_name' => 'Diclofenac Sodium', 'category' => 'Analgesic', 'supplier' => 'Cosmos Limited', 'quantity' => 3, 'reorder_level' => 10, 'buying_price' => 150, 'selling_price' => 220, 'expiry_date' => now()->subDays(10), 'batch_number' => 'BATCH008'],
            ['name' => 'Multivitamin Syrup', 'generic_name' => 'Multivitamins', 'category' => 'Vitamin', 'supplier' => 'Dawa Ltd Nairobi', 'quantity' => 75, 'reorder_level' => 20, 'buying_price' => 180, 'selling_price' => 260, 'expiry_date' => now()->addMonths(20), 'batch_number' => 'BATCH009'],
            ['name' => 'Azithromycin 250mg', 'generic_name' => 'Azithromycin', 'category' => 'Antibiotic', 'supplier' => 'Medisel Kenya Ltd', 'quantity' => 40, 'reorder_level' => 15, 'buying_price' => 250, 'selling_price' => 380, 'expiry_date' => now()->addMonths(10), 'batch_number' => 'BATCH010'],
            ['name' => 'Loperamide 2mg', 'generic_name' => 'Loperamide HCl', 'category' => 'Antidiarrheal', 'supplier' => 'PharmaTrust EA', 'quantity' => 55, 'reorder_level' => 15, 'buying_price' => 50, 'selling_price' => 85, 'expiry_date' => now()->addMonths(14), 'batch_number' => 'BATCH011'],
            ['name' => 'Aspirin 75mg', 'generic_name' => 'Acetylsalicylic Acid', 'category' => 'Analgesic', 'supplier' => 'Goodlife Distributors', 'quantity' => 110, 'reorder_level' => 25, 'buying_price' => 30, 'selling_price' => 55, 'expiry_date' => now()->addMonths(16), 'batch_number' => 'BATCH012'],
            ['name' => 'Ciprofloxacin 500mg', 'generic_name' => 'Ciprofloxacin', 'category' => 'Antibiotic', 'supplier' => 'Universal Pharma Supplies', 'quantity' => 6, 'reorder_level' => 20, 'buying_price' => 180, 'selling_price' => 260, 'expiry_date' => now()->addDays(25), 'batch_number' => 'BATCH013'],
            ['name' => 'Salbutamol Inhaler', 'generic_name' => 'Salbutamol', 'category' => 'Bronchodilator', 'supplier' => 'Kenya Medical Supplies Authority', 'quantity' => 35, 'reorder_level' => 10, 'buying_price' => 350, 'selling_price' => 500, 'expiry_date' => now()->addMonths(11), 'batch_number' => 'BATCH014'],
            ['name' => 'Hydrocortisone Cream', 'generic_name' => 'Hydrocortisone', 'category' => 'Dermatological', 'supplier' => 'Goodlife Distributors', 'quantity' => 48, 'reorder_level' => 15, 'buying_price' => 110, 'selling_price' => 180, 'expiry_date' => now()->addMonths(13), 'batch_number' => 'BATCH015'],
            ['name' => 'Insulin Glargine', 'generic_name' => 'Insulin Glargine', 'category' => 'Antidiabetic', 'supplier' => 'Kenya Medical Supplies Authority', 'quantity' => 12, 'reorder_level' => 8, 'buying_price' => 1200, 'selling_price' => 1650, 'expiry_date' => now()->addMonths(6), 'batch_number' => 'BATCH016'],
            ['name' => 'Folic Acid 5mg', 'generic_name' => 'Folic Acid', 'category' => 'Vitamin', 'supplier' => 'Dawa Ltd Nairobi', 'quantity' => 160, 'reorder_level' => 30, 'buying_price' => 25, 'selling_price' => 45, 'expiry_date' => now()->addMonths(22), 'batch_number' => 'BATCH017'],
            ['name' => 'Doxycycline 100mg', 'generic_name' => 'Doxycycline', 'category' => 'Antibiotic', 'supplier' => 'Medisel Kenya Ltd', 'quantity' => 4, 'reorder_level' => 15, 'buying_price' => 140, 'selling_price' => 210, 'expiry_date' => now()->subDays(5), 'batch_number' => 'BATCH018'],
            ['name' => 'Loratadine 10mg', 'generic_name' => 'Loratadine', 'category' => 'Antihistamine', 'supplier' => 'PharmaTrust EA', 'quantity' => 70, 'reorder_level' => 20, 'buying_price' => 45, 'selling_price' => 75, 'expiry_date' => now()->addMonths(17), 'batch_number' => 'BATCH019'],
            ['name' => 'Amlodipine 5mg', 'generic_name' => 'Amlodipine Besylate', 'category' => 'Antihypertensive', 'supplier' => 'Universal Pharma Supplies', 'quantity' => 85, 'reorder_level' => 20, 'buying_price' => 70, 'selling_price' => 115, 'expiry_date' => now()->addMonths(19), 'batch_number' => 'BATCH020'],
            ['name' => 'Magnesium Sulphate Inj', 'generic_name' => 'Magnesium Sulphate', 'category' => 'Electrolyte', 'supplier' => 'Kenya Medical Supplies Authority', 'quantity' => 25, 'reorder_level' => 10, 'buying_price' => 95, 'selling_price' => 150, 'expiry_date' => now()->addMonths(9), 'batch_number' => 'BATCH021'],
            ['name' => 'Ferrous Sulphate 200mg', 'generic_name' => 'Ferrous Sulphate', 'category' => 'Vitamin', 'supplier' => 'Dawa Ltd Nairobi', 'quantity' => 130, 'reorder_level' => 30, 'buying_price' => 20, 'selling_price' => 40, 'expiry_date' => now()->addMonths(21), 'batch_number' => 'BATCH022'],
            ['name' => 'Albendazole 400mg', 'generic_name' => 'Albendazole', 'category' => 'Antiparasitic', 'supplier' => 'Cosmos Limited', 'quantity' => 65, 'reorder_level' => 20, 'buying_price' => 35, 'selling_price' => 60, 'expiry_date' => now()->addMonths(15), 'batch_number' => 'BATCH023'],
            ['name' => 'Prednisolone 5mg', 'generic_name' => 'Prednisolone', 'category' => 'Corticosteroid', 'supplier' => 'Goodlife Distributors', 'quantity' => 7, 'reorder_level' => 15, 'buying_price' => 65, 'selling_price' => 100, 'expiry_date' => now()->addDays(18), 'batch_number' => 'BATCH024'],
            ['name' => 'Co-trimoxazole 480mg', 'generic_name' => 'Sulfamethoxazole/Trimethoprim', 'category' => 'Antibiotic', 'supplier' => 'Medisel Kenya Ltd', 'quantity' => 95, 'reorder_level' => 25, 'buying_price' => 55, 'selling_price' => 90, 'expiry_date' => now()->addMonths(13), 'batch_number' => 'BATCH025'],
            ['name' => 'Mebendazole 100mg', 'generic_name' => 'Mebendazole', 'category' => 'Antiparasitic', 'supplier' => 'PharmaTrust EA', 'quantity' => 100, 'reorder_level' => 25, 'buying_price' => 15, 'selling_price' => 30, 'expiry_date' => now()->addMonths(20), 'batch_number' => 'BATCH026'],
            ['name' => 'Ranitidine 150mg', 'generic_name' => 'Ranitidine', 'category' => 'Antacid', 'supplier' => 'Cosmos Limited', 'quantity' => 2, 'reorder_level' => 15, 'buying_price' => 40, 'selling_price' => 70, 'expiry_date' => now()->subDays(3), 'batch_number' => 'BATCH027'],
            ['name' => 'Calcium Carbonate 500mg', 'generic_name' => 'Calcium Carbonate', 'category' => 'Supplement', 'supplier' => 'Dawa Ltd Nairobi', 'quantity' => 145, 'reorder_level' => 30, 'buying_price' => 30, 'selling_price' => 55, 'expiry_date' => now()->addMonths(23), 'batch_number' => 'BATCH028'],
            ['name' => 'Tramadol 50mg', 'generic_name' => 'Tramadol HCl', 'category' => 'Analgesic', 'supplier' => 'Universal Pharma Supplies', 'quantity' => 30, 'reorder_level' => 15, 'buying_price' => 85, 'selling_price' => 140, 'expiry_date' => now()->addMonths(12), 'batch_number' => 'BATCH029'],
            ['name' => 'Glucose Powder 50g', 'generic_name' => 'Dextrose', 'category' => 'Supplement', 'supplier' => 'Goodlife Distributors', 'quantity' => 80, 'reorder_level' => 20, 'buying_price' => 60, 'selling_price' => 100, 'expiry_date' => now()->addMonths(24), 'batch_number' => 'BATCH030'],
        ];

        foreach ($medicines as $medicine) {
            Medicine::create($medicine);
        }

        $admin = User::where('role', 'admin')->first();
        $pharmacist = User::where('role', 'pharmacist')->first();
        $cashier = User::where('role', 'cashier')->first();
        $allMedicines = Medicine::all();
        $allSuppliers = Supplier::pluck('id')->toArray();

        // Purchases (12 orders, mix of received and pending)
        $poNumber = 1;
        for ($i = 0; $i < 12; $i++) {
            $medicine = $allMedicines->random();
            $qty = rand(20, 80);
            $unitPrice = $medicine->buying_price;
            $subtotal = $qty * $unitPrice;
            $status = $i < 8 ? 'received' : 'pending';
            $orderDate = now()->subDays(rand(3, 40));

            $purchase = Purchase::create([
                'supplier_id' => $allSuppliers[array_rand($allSuppliers)],
                'user_id' => $pharmacist ? $pharmacist->id : $admin->id,
                'reference_number' => 'PO-' . str_pad($poNumber, 5, '0', STR_PAD_LEFT),
                'total_amount' => $subtotal,
                'status' => $status,
                'order_date' => $orderDate,
                'expected_date' => $orderDate->copy()->addDays(5),
                'received_date' => $status === 'received' ? $orderDate->copy()->addDays(rand(2, 5)) : null,
            ]);

            PurchaseItem::create([
                'purchase_id' => $purchase->id,
                'medicine_id' => $medicine->id,
                'quantity' => $qty,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
            ]);

            $poNumber++;
        }

        // Sales (40 transactions over the last 14 days)
        if ($cashier) {
            $rcpNumber = 1;
            $customerNames = [null, null, null, 'Jane Mwangi', 'Daniel Otieno', 'Faith Wairimu', null, 'Kevin Omondi', null, 'Lillian Chebet'];
            $paymentMethods = ['cash', 'cash', 'mpesa', 'mpesa', 'mpesa', 'insurance'];

            for ($i = 0; $i < 40; $i++) {
                $sale = Sale::create([
                    'user_id' => $cashier->id,
                    'receipt_number' => 'RCP-' . str_pad($rcpNumber, 5, '0', STR_PAD_LEFT),
                    'total_amount' => 0,
                    'amount_paid' => 0,
                    'change_given' => 0,
                    'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                    'customer_name' => $customerNames[array_rand($customerNames)],
                    'created_at' => now()->subDays(rand(0, 13))->subHours(rand(1, 11))->subMinutes(rand(0, 59)),
                ]);

                $itemCount = rand(1, 3);
                $total = 0;
                $usedMedicines = [];

                for ($j = 0; $j < $itemCount; $j++) {
                    $medicine = $allMedicines->random();
                    if (in_array($medicine->id, $usedMedicines)) continue;
                    $usedMedicines[] = $medicine->id;

                    $qty = rand(1, 4);
                    $subtotal = $medicine->selling_price * $qty;
                    $total += $subtotal;

                    SaleItem::create([
                        'sale_id' => $sale->id,
                        'medicine_id' => $medicine->id,
                        'quantity' => $qty,
                        'unit_price' => $medicine->selling_price,
                        'subtotal' => $subtotal,
                    ]);
                }

                $amountPaid = $total + [0, 0, 50, 100, 200][array_rand([0, 0, 50, 100, 200])];

                $sale->update([
                    'total_amount' => $total,
                    'amount_paid' => $amountPaid,
                    'change_given' => $amountPaid - $total,
                ]);

                $rcpNumber++;
            }
        }
    }
}