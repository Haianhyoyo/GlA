<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            WebsiteSettingSeeder::class,
        ]);

        // Services
        \App\Models\Service::create([
            'title' => 'Siêu âm',
            'description' => 'Cung cấp các dịch vụ siêu âm chất lượng cao.',
            'image' => 'https://via.placeholder.com/400x300?text=Sieu+Am',
            'features' => ['Siêu âm 2D', 'Siêu âm 3D', 'Siêu âm 4D']
        ]);
        \App\Models\Service::create([
            'title' => 'Khám sản phụ khoa',
            'description' => 'Chăm sóc sức khỏe phụ nữ toàn diện.',
            'image' => 'https://via.placeholder.com/400x300?text=San+Phu+Khoa',
            'features' => ['Phụ khoa nội tiết tuyến', 'Bệnh lý liên quan phụ nữ', 'Viêm nhiễm phụ khoa', 'Khám vô sinh']
        ]);
        \App\Models\Service::create([
            'title' => 'Kế hoạch hóa gia đình',
            'description' => 'Hỗ trợ các giải pháp kế hoạch hóa.',
            'image' => 'https://via.placeholder.com/400x300?text=Ke+Hoach+Hoa',
            'features' => ['Đặt vòng tránh thai', 'Cấy que tránh thai']
        ]);
        \App\Models\Service::create([
            'title' => 'Khám thai',
            'description' => 'Theo dõi sự phát triển của thai nhi.',
            'image' => 'https://via.placeholder.com/400x300?text=Kham+Thai',
            'features' => ['Hỗ trợ sinh sản', 'Theo dõi thai định kỳ', 'Xét nghiệm', 'Tư vấn sức khỏe']
        ]);

        // News
        \App\Models\News::create([
            'title' => 'Những dấu hiệu bệnh không nên bỏ qua',
            'summary' => 'Nhiều chị em phụ nữ thường hay chủ quan trước những dấu hiệu bất thường...',
            'image' => 'https://via.placeholder.com/150x100?text=News+1'
        ]);
        \App\Models\News::create([
            'title' => '7 điều mẹ bầu nên làm để con trong bụng khỏe mạnh',
            'summary' => 'Hỏi đáp y học: Sức khỏe bà bầu và những điều mẹ cần biết...',
            'image' => 'https://via.placeholder.com/150x100?text=News+2'
        ]);

        // Testimonials
        \App\Models\Testimonial::create([
            'author' => 'Nguyễn Hằng Nga',
            'info' => '23 tuổi, Thanh Xuân - Hà Nội',
            'content' => 'Tôi hoàn toàn hài lòng với dịch vụ tại đây. Đội ngũ y bác sĩ rất tận tâm và chuyên nghiệp. Sau khi được tư vấn và điều trị, sức khỏe của tôi đã ổn định hơn rất nhiều.',
            'image' => 'https://via.placeholder.com/100x100?text=AVT'
        ]);

        // FAQs
        \App\Models\Faq::create([
            'question' => 'Thời điểm nào nên khám thai lần đầu?',
            'answer' => 'Nên đi khám ngay sau khi trễ kinh và có dấu hiệu mang thai.'
        ]);
        \App\Models\Faq::create([
            'question' => 'Khám phụ khoa định kỳ bao lâu 1 lần?',
            'answer' => 'Nên khám định kỳ 6 tháng hoặc 1 năm một lần.'
        ]);
    }
}
