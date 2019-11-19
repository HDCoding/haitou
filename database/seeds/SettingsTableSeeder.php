<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ['display_name' => 'Site título', 'key' => 'site_title', 'value' => 'Forum'],
            ['display_name' => 'Meta Keywords', 'key' => 'meta_keywords', 'value' => ''],
            ['display_name' => 'Meta Description', 'key' => 'meta_description', 'value' => ''],
            ['display_name' => 'Analytics', 'key' => 'analytics', 'value' => ''],
            //Social
            ['display_name' => 'Facebook', 'key' => 'facebook', 'value' => ''],
            ['display_name' => 'Twitter', 'key' => 'twitter', 'value' => ''],
            ['display_name' => 'Pinterest', 'key' => 'pinterest', 'value' => ''],
            ['display_name' => 'Youtube', 'key' => 'youtube', 'value' => ''],
            ['display_name' => 'Instagram', 'key' => 'instagram', 'value' => ''],
            ['display_name' => 'Twitch', 'key' => 'twitch', 'value' => ''],
            ['display_name' => 'Discord', 'key' => 'discord', 'value' => ''],

            ['display_name' => 'Signup On', 'key' => 'signup_on', 'value' => '1'],
            ['display_name' => 'Convite On', 'key' => 'invite_on', 'value' => '1'],
            ['display_name' => 'forum On', 'key' => 'forum_on', 'value' => '1'],
            ['display_name' => 'RNH On', 'key' => 'rnh_on', 'value' => '1'],

            ['display_name' => 'Ratio Máximo', 'key' => 'max_ratio', 'value' => '2.000'],
            ['display_name' => 'Ratio Mínimo', 'key' => 'min_ratio', 'value' => '1.200'],
            ['display_name' => 'Ratio Baixo', 'key' => 'low_ratio', 'value' => '0.550'],

            ['display_name' => 'Dias para expirar convite', 'key' => 'invitedays', 'value' => '7'],

            //Points
            ['display_name' => 'Pontos signup', 'key' => 'points_signup', 'value' => '200'],
            ['display_name' => 'Pontos invite', 'key' => 'points_invite', 'value' => '100'],
            ['display_name' => 'Pontos download', 'key' => 'points_download', 'value' => '20'],
            ['display_name' => 'Pontos comment', 'key' => 'points_comment', 'value' => '4'],
            ['display_name' => 'Pontos upload', 'key' => 'points_upload', 'value' => '30'],
            ['display_name' => 'Pontos rating', 'key' => 'points_rating', 'value' => '5'],
            ['display_name' => 'Pontos topic', 'key' => 'points_topic', 'value' => '8'],
            ['display_name' => 'Pontos post', 'key' => 'points_post', 'value' => '5'],
            ['display_name' => 'Pontos delete', 'key' => 'points_delete', 'value' => '15'],
            ['display_name' => 'Pontos thanks', 'key' => 'points_thanks', 'value' => '5'],
            ['display_name' => 'Pontos report', 'key' => 'points_report', 'value' => '5'],

            //policy
            ['display_name' => 'Privacidade', 'key' => 'privacy', 'value' => ''],
            ['display_name' => 'Aviso Legal', 'key' => 'disclaimer', 'value' => ''],
            ['display_name' => 'Termos e Condições', 'key' => 'terms', 'value' => ''],

            //Mail
            ['display_name' => 'Mail driver', 'key' => 'mail_driver', 'value' => ''],
            ['display_name' => 'Mail host', 'key' => 'mail_host', 'value' => ''],
            ['display_name' => 'Mail porta', 'key' => 'mail_port', 'value' => ''],
            ['display_name' => 'Mail usuario', 'key' => 'mail_username', 'value' => ''],
            ['display_name' => 'Mail senha', 'key' => 'mail_password', 'value' => ''],
            ['display_name' => 'Mail tls', 'key' => 'mail_encryption', 'value' => ''],
            //Others
            ['display_name' => 'Favicon', 'key' => 'favicon', 'value' => ''],
            ['display_name' => 'Logo', 'key' => 'logo', 'value' => ''],
            ['display_name' => 'Login-Registro Imagem', 'key' => 'login_register_image', 'value' => ''],
            ['display_name' => 'Imagem Inicial', 'key' => 'index_image', 'value' => ''],
            ['display_name' => 'Imagem Home', 'key' => 'home_image', 'value' => ''],

        ];
        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
