<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            //Seo
            ['key' => 'site_title', 'value' => 'Forum'],
            ['key' => 'meta_keywords', 'value' => ''],
            ['key' => 'meta_description', 'value' => ''],
            ['key' => 'analytics', 'value' => ''],
            //Social
            ['key' => 'facebook', 'value' => ''],
            ['key' => 'twitter', 'value' => ''],
            ['key' => 'pinterest', 'value' => ''],
            ['key' => 'youtube', 'value' => ''],
            ['key' => 'instagram', 'value' => ''],
            ['key' => 'twitch', 'value' => ''],
            ['key' => 'discord', 'value' => ''],
            //Others
            ['key' => 'signup_on', 'value' => '1'],
            ['key' => 'invite_on', 'value' => '1'],
            ['key' => 'forum_on', 'value' => '1'],
            ['key' => 'rnh_on', 'value' => '1'],
            ['key' => 'max_ratio', 'value' => '2.000'],
            ['key' => 'min_ratio', 'value' => '1.200'],
            ['key' => 'low_ratio', 'value' => '0.550'],
            ['key' => 'invite_days', 'value' => '7'],
            //Points
            ['key' => 'points_signup', 'value' => '200'],
            ['key' => 'points_invite', 'value' => '100'],
            ['key' => 'points_download', 'value' => '20'],
            ['key' => 'points_comment', 'value' => '4'],
            ['key' => 'points_upload', 'value' => '30'],
            ['key' => 'points_rating', 'value' => '5'],
            ['key' => 'points_topic', 'value' => '8'],
            ['key' => 'points_post', 'value' => '5'],
            ['key' => 'points_delete', 'value' => '15'],
            ['key' => 'points_thanks', 'value' => '5'],
            ['key' => 'points_report', 'value' => '5'],
            ['key' => 'points_calendar', 'value' => '50'],
            //Policy
            ['key' => 'privacy', 'value' => ''],
            ['key' => 'disclaimer', 'value' => 'Nenhum dos arquivos mostrados aqui está realmente hospedado neste servidor. Os links são fornecidos
                exclusivamente pelos usuários deste site. O administrador deste site não pode ser responsabilizado por
                o que seus usuários postam ou qualquer outra ação de seus usuários. Você não pode usar este site para
                distribuir ou baixar qualquer material quando você não tem os direitos legais para fazê-lo. Isto é sua
                própria responsabilidade de aderir a estes termos.'],
            ['key' => 'terms', 'value' => ''],
            //Mail
            ['key' => 'mail_driver', 'value' => ''],
            ['key' => 'mail_host', 'value' => ''],
            ['key' => 'mail_port', 'value' => ''],
            ['key' => 'mail_username', 'value' => ''],
            ['key' => 'mail_password', 'value' => ''],
            ['key' => 'mail_encryption', 'value' => ''],

        ];
        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
