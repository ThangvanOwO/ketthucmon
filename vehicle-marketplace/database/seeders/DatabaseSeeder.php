<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Tạo permissions
        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'manage products']);
        Permission::create(['name' => 'manage categories']);
        Permission::create(['name' => 'manage orders']);
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'view dashboard']);
        Permission::create(['name' => 'place orders']);

        // Tạo roles
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'view products', 'manage products', 'manage categories',
            'manage orders', 'manage users', 'view dashboard', 'place orders',
        ]);

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo(['view products', 'place orders']);

        // Tạo user admin
        $admin = User::create([
            'email' => 'admin@kinetic.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);
        $admin->assignRole('admin');

        // Tạo user thường
        $user = User::create([
            'email' => 'user@kinetic.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
        ]);
        $user->assignRole('user');

        // Tạo danh mục
        $xeHoi = Category::create(['name' => 'Xe hơi']);
        $xeMay = Category::create(['name' => 'Xe máy']);
        $xeDien = Category::create(['name' => 'Xe điện']);

        // ==================== XE HƠI ====================

        $gtr = Product::create([
            'name' => 'Kinetic GT-R',
            'slug' => 'kinetic-gt-r',
            'description' => 'Siêu xe thể thao với động cơ V8 Twin-Turbo, 800 mã lực. Tăng tốc 0-100km/h trong 2.8 giây. Thiết kế khí động học tối ưu với thân xe bằng sợi carbon.',
            'image' => 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?w=800&q=80',
            'price' => 3500000000,
            'quantity' => 5,
            'view' => 120,
            'category_id' => $xeHoi->id,
        ]);
        $this->seedImages($gtr->id, [
            ['https://images.unsplash.com/photo-1544636331-e26879cd4d9b?w=800&q=80', 'Kinetic GT-R - Ngoại thất'],
            ['https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&q=80', 'Kinetic GT-R - Góc nghiêng'],
            ['https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800&q=80', 'Kinetic GT-R - Động cơ'],
            ['https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800&q=80', 'Kinetic GT-R - Nội thất'],
            ['https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=800&q=80', 'Kinetic GT-R - Toàn cảnh'],
        ]);

        $sedan = Product::create([
            'name' => 'Kinetic Luxury Sedan',
            'slug' => 'kinetic-luxury-sedan',
            'description' => 'Sedan hạng sang với nội thất da cao cấp, hệ thống giải trí tiên tiến và công nghệ lái tự động cấp 3. Khoang cabin yên tĩnh tuyệt đối.',
            'image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&q=80',
            'price' => 2800000000,
            'quantity' => 8,
            'view' => 95,
            'category_id' => $xeHoi->id,
        ]);
        $this->seedImages($sedan->id, [
            ['https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&q=80', 'Kinetic Luxury Sedan - Ngoại thất'],
            ['https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=800&q=80', 'Kinetic Luxury Sedan - Nội thất'],
            ['https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=800&q=80', 'Kinetic Luxury Sedan - Góc phía sau'],
            ['https://images.unsplash.com/photo-1502877338535-766e1452684a?w=800&q=80', 'Kinetic Luxury Sedan - Đèn pha'],
            ['https://images.unsplash.com/photo-1504215680853-026ed2a45def?w=800&q=80', 'Kinetic Luxury Sedan - Bảng điều khiển'],
        ]);

        $suv = Product::create([
            'name' => 'Kinetic SUV Terra-X',
            'slug' => 'kinetic-suv-terra-x',
            'description' => 'SUV địa hình cao cấp, dẫn động 4 bánh toàn thời gian với khả năng off-road vượt trội. Khoang hành lý rộng rãi 650L.',
            'image' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800&q=80',
            'price' => 2200000000,
            'quantity' => 10,
            'view' => 78,
            'category_id' => $xeHoi->id,
        ]);
        $this->seedImages($suv->id, [
            ['https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800&q=80', 'Kinetic SUV Terra-X - Ngoại thất'],
            ['https://images.unsplash.com/photo-1542362567-b07e54358753?w=800&q=80', 'Kinetic SUV Terra-X - Địa hình'],
            ['https://images.unsplash.com/photo-1553440569-bcc63803a83d?w=800&q=80', 'Kinetic SUV Terra-X - Góc nghiêng'],
            ['https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=800&q=80', 'Kinetic SUV Terra-X - Đỗ xe'],
            ['https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?w=800&q=80', 'Kinetic SUV Terra-X - Khoang hành lý'],
        ]);

        $coupe = Product::create([
            'name' => 'Kinetic Coupe Sport',
            'slug' => 'kinetic-coupe-sport',
            'description' => 'Coupe thể thao 2 cửa với thiết kế mui trần quyến rũ. Động cơ V6 3.0L tăng áp, 400 mã lực, hệ thống ống xả thể thao.',
            'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&q=80',
            'price' => 4200000000,
            'quantity' => 3,
            'view' => 250,
            'category_id' => $xeHoi->id,
        ]);
        $this->seedImages($coupe->id, [
            ['https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&q=80', 'Kinetic Coupe Sport - Ngoại thất'],
            ['https://images.unsplash.com/photo-1605559424843-9e4c228bf1c2?w=800&q=80', 'Kinetic Coupe Sport - Mui trần'],
            ['https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800&q=80', 'Kinetic Coupe Sport - Động cơ'],
            ['https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800&q=80', 'Kinetic Coupe Sport - Nội thất'],
            ['https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=800&q=80', 'Kinetic Coupe Sport - Đêm'],
        ]);

        // ==================== XE MÁY ====================

        $moto = Product::create([
            'name' => 'Kinetic M-1 Sport',
            'slug' => 'kinetic-m-1-sport',
            'description' => 'Xe máy thể thao với thiết kế khí động học, động cơ 1000cc và hệ thống phanh ABS tiên tiến. Tốc độ tối đa 299km/h.',
            'image' => 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?w=800&q=80',
            'price' => 450000000,
            'quantity' => 15,
            'view' => 200,
            'category_id' => $xeMay->id,
        ]);
        $this->seedImages($moto->id, [
            ['https://images.unsplash.com/photo-1558981806-ec527fa84c39?w=800&q=80', 'Kinetic M-1 Sport - Toàn cảnh'],
            ['https://images.unsplash.com/photo-1558981359-219d6364c9c8?w=800&q=80', 'Kinetic M-1 Sport - Góc nghiêng'],
            ['https://images.unsplash.com/photo-1558980394-4c7c9299fe96?w=800&q=80', 'Kinetic M-1 Sport - Động cơ'],
            ['https://images.unsplash.com/photo-1530026405186-ed1f139313f8?w=800&q=80', 'Kinetic M-1 Sport - Đèn pha'],
            ['https://images.unsplash.com/photo-1526726538690-5cbf956ae2fd?w=800&q=80', 'Kinetic M-1 Sport - Trên đường'],
        ]);

        $cruiser = Product::create([
            'name' => 'Kinetic Phantom Cruiser',
            'slug' => 'kinetic-phantom-cruiser',
            'description' => 'Cruiser cổ điển với động cơ V-Twin 1200cc, yên da thật và ống xả chrome sáng bóng. Phong cách hoài cổ đẳng cấp.',
            'image' => 'https://images.unsplash.com/photo-1547549082-6bc09f2049ae?w=800&q=80',
            'price' => 380000000,
            'quantity' => 12,
            'view' => 150,
            'category_id' => $xeMay->id,
        ]);
        $this->seedImages($cruiser->id, [
            ['https://images.unsplash.com/photo-1547549082-6bc09f2049ae?w=800&q=80', 'Kinetic Phantom Cruiser - Toàn cảnh'],
            ['https://images.unsplash.com/photo-1558981359-219d6364c9c8?w=800&q=80', 'Kinetic Phantom Cruiser - Chi tiết'],
            ['https://images.unsplash.com/photo-1558980394-4c7c9299fe96?w=800&q=80', 'Kinetic Phantom Cruiser - Động cơ V-Twin'],
            ['https://images.unsplash.com/photo-1519583272095-6433daf26b6e?w=800&q=80', 'Kinetic Phantom Cruiser - Ống xả'],
            ['https://images.unsplash.com/photo-1530026405186-ed1f139313f8?w=800&q=80', 'Kinetic Phantom Cruiser - Trên đường'],
        ]);

        $scooter = Product::create([
            'name' => 'Kinetic Scooter Urban',
            'slug' => 'kinetic-scooter-urban',
            'description' => 'Xe tay ga đô thị tiện lợi, tiết kiệm nhiên liệu với thiết kế hiện đại và ngăn chứa đồ rộng rãi. Phù hợp di chuyển trong thành phố.',
            'image' => 'https://images.unsplash.com/photo-1591637333184-19aa84b3e01f?w=800&q=80',
            'price' => 85000000,
            'quantity' => 25,
            'view' => 300,
            'category_id' => $xeMay->id,
        ]);
        $this->seedImages($scooter->id, [
            ['https://images.unsplash.com/photo-1591637333184-19aa84b3e01f?w=800&q=80', 'Kinetic Scooter Urban - Toàn cảnh'],
            ['https://images.unsplash.com/photo-1558981359-219d6364c9c8?w=800&q=80', 'Kinetic Scooter Urban - Góc nghiêng'],
            ['https://images.unsplash.com/photo-1558980394-4c7c9299fe96?w=800&q=80', 'Kinetic Scooter Urban - Chi tiết'],
            ['https://images.unsplash.com/photo-1526726538690-5cbf956ae2fd?w=800&q=80', 'Kinetic Scooter Urban - Trên đường'],
            ['https://images.unsplash.com/photo-1519583272095-6433daf26b6e?w=800&q=80', 'Kinetic Scooter Urban - Đỗ xe'],
        ]);

        $adventure = Product::create([
            'name' => 'Kinetic Adventure Touring',
            'slug' => 'kinetic-adventure-touring',
            'description' => 'Xe adventure touring đa địa hình, động cơ 800cc, hệ thống treo hành trình dài. Lý tưởng cho những chuyến phiêu lưu.',
            'image' => 'https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?w=800&q=80',
            'price' => 520000000,
            'quantity' => 8,
            'view' => 180,
            'category_id' => $xeMay->id,
        ]);
        $this->seedImages($adventure->id, [
            ['https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?w=800&q=80', 'Kinetic Adventure Touring - Toàn cảnh'],
            ['https://images.unsplash.com/photo-1558981806-ec527fa84c39?w=800&q=80', 'Kinetic Adventure Touring - Off-road'],
            ['https://images.unsplash.com/photo-1558981359-219d6364c9c8?w=800&q=80', 'Kinetic Adventure Touring - Chi tiết'],
            ['https://images.unsplash.com/photo-1530026405186-ed1f139313f8?w=800&q=80', 'Kinetic Adventure Touring - Đèn pha'],
            ['https://images.unsplash.com/photo-1526726538690-5cbf956ae2fd?w=800&q=80', 'Kinetic Adventure Touring - Trên đường'],
        ]);

        // ==================== XE ĐIỆN ====================

        $eSedan = Product::create([
            'name' => 'Kinetic E-Sedan Aero',
            'slug' => 'kinetic-e-sedan-aero',
            'description' => 'Sedan điện với phạm vi 450km, động cơ kép AWD 1024 mã lực. Sạc nhanh 0-80% trong 20 phút. Không khí thải.',
            'image' => 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?w=800&q=80',
            'price' => 1800000000,
            'quantity' => 7,
            'view' => 180,
            'category_id' => $xeDien->id,
        ]);
        $this->seedImages($eSedan->id, [
            ['https://images.unsplash.com/photo-1560958089-b8a1929cea89?w=800&q=80', 'Kinetic E-Sedan Aero - Ngoại thất'],
            ['https://images.unsplash.com/photo-1616788494707-ec28f08d05a1?w=800&q=80', 'Kinetic E-Sedan Aero - Nội thất'],
            ['https://images.unsplash.com/photo-1619405399517-d7fce0f13302?w=800&q=80', 'Kinetic E-Sedan Aero - Cổng sạc'],
            ['https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&q=80', 'Kinetic E-Sedan Aero - Góc nghiêng'],
            ['https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=800&q=80', 'Kinetic E-Sedan Aero - Toàn cảnh'],
        ]);

        $eMoto = Product::create([
            'name' => 'Kinetic E-Moto Pro',
            'slug' => 'kinetic-e-moto-pro',
            'description' => 'Xe máy điện hiệu suất cao, tốc độ tối đa 200km/h với phạm vi 250km mỗi lần sạc. Mô-men xoắn tức thì.',
            'image' => 'https://images.unsplash.com/photo-1571068316344-75bc76f77890?w=800&q=80',
            'price' => 250000000,
            'quantity' => 20,
            'view' => 250,
            'category_id' => $xeDien->id,
        ]);
        $this->seedImages($eMoto->id, [
            ['https://images.unsplash.com/photo-1571068316344-75bc76f77890?w=800&q=80', 'Kinetic E-Moto Pro - Toàn cảnh'],
            ['https://images.unsplash.com/photo-1558981359-219d6364c9c8?w=800&q=80', 'Kinetic E-Moto Pro - Góc nghiêng'],
            ['https://images.unsplash.com/photo-1558980394-4c7c9299fe96?w=800&q=80', 'Kinetic E-Moto Pro - Động cơ điện'],
            ['https://images.unsplash.com/photo-1530026405186-ed1f139313f8?w=800&q=80', 'Kinetic E-Moto Pro - Đèn pha LED'],
            ['https://images.unsplash.com/photo-1526726538690-5cbf956ae2fd?w=800&q=80', 'Kinetic E-Moto Pro - Trên đường'],
        ]);

        $eScooter = Product::create([
            'name' => 'Kinetic E-Scooter City',
            'slug' => 'kinetic-e-scooter-city',
            'description' => 'Xe scooter điện đô thị, nhỏ gọn và thân thiện môi trường. Phạm vi 100km, sạc đầy trong 4 giờ.',
            'image' => 'https://images.unsplash.com/photo-1580310614729-ccd69652491d?w=800&q=80',
            'price' => 35000000,
            'quantity' => 50,
            'view' => 500,
            'category_id' => $xeDien->id,
        ]);
        $this->seedImages($eScooter->id, [
            ['https://images.unsplash.com/photo-1580310614729-ccd69652491d?w=800&q=80', 'Kinetic E-Scooter City - Toàn cảnh'],
            ['https://images.unsplash.com/photo-1591637333184-19aa84b3e01f?w=800&q=80', 'Kinetic E-Scooter City - Góc nghiêng'],
            ['https://images.unsplash.com/photo-1558981359-219d6364c9c8?w=800&q=80', 'Kinetic E-Scooter City - Chi tiết'],
            ['https://images.unsplash.com/photo-1526726538690-5cbf956ae2fd?w=800&q=80', 'Kinetic E-Scooter City - Trên đường'],
            ['https://images.unsplash.com/photo-1519583272095-6433daf26b6e?w=800&q=80', 'Kinetic E-Scooter City - Đỗ xe'],
        ]);

        $eSuv = Product::create([
            'name' => 'Kinetic E-SUV Terra',
            'slug' => 'kinetic-e-suv-terra',
            'description' => 'SUV điện 7 chỗ với phạm vi 500km. Hệ thống pin 100kW, sạc siêu nhanh 15 phút đi được 200km.',
            'image' => 'https://images.unsplash.com/photo-1619767886558-efdc259cde1a?w=800&q=80',
            'price' => 2500000000,
            'quantity' => 6,
            'view' => 160,
            'category_id' => $xeDien->id,
        ]);
        $this->seedImages($eSuv->id, [
            ['https://images.unsplash.com/photo-1619767886558-efdc259cde1a?w=800&q=80', 'Kinetic E-SUV Terra - Ngoại thất'],
            ['https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800&q=80', 'Kinetic E-SUV Terra - Địa hình'],
            ['https://images.unsplash.com/photo-1622127922040-13cab637ee78?w=800&q=80', 'Kinetic E-SUV Terra - Nội thất'],
            ['https://images.unsplash.com/photo-1542362567-b07e54358753?w=800&q=80', 'Kinetic E-SUV Terra - Góc nghiêng'],
            ['https://images.unsplash.com/photo-1609521263047-f8f205293f24?w=800&q=80', 'Kinetic E-SUV Terra - Cổng sạc'],
        ]);
    }

    /**
     * Seed gallery images for a product
     */
    private function seedImages(int $productId, array $images): void
    {
        foreach ($images as $index => [$url, $alt]) {
            ProductImage::create([
                'product_id' => $productId,
                'image_url' => $url,
                'alt_text' => $alt,
                'sort_order' => $index,
            ]);
        }
    }
}
