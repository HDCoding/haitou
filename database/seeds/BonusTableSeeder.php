<?php

use App\Models\Bonus;
use Illuminate\Database\Seeder;

class BonusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bonus = [
            [
                'name' => '1GB Uploaded',
                'description' => 'Com pontos de bônus suficientes adquiridos, você pode trocá-los por um Crédito de Upload. Os pontos são então removidos do seu Banco de Bônus e o crédito é adicionado ao o seu montante total carregado.',
                'cost'=> 275,
                'quantity' => 1073741824,
                'bonus_type'=> 1,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '2.5GB Uploaded',
                'description' => 'Com pontos de bónus suficientes adquiridos, pode trocá-los por um Crédito de Upload Os pontos são então retirados do seu Banco de Bónus e o crédito é adicionado ao seu montante total carregado.',
                'cost'=> 350,
                'quantity' => 2684354560,
                'bonus_type'=> 1,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '5GB Uploaded',
                'description' => 'Com pontos de bônus suficientes adquiridos, você pode trocá-los por um Crédito de Upload. Os pontos são removidos do seu Banco de Bônus e o crédito é adicionado ao seu total de upload.',
                'cost'=> 550,
                'quantity' => 5368709120,
                'bonus_type'=> 1,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '10GB Uploaded',
                'description' => 'Com pontos de bônus suficientes adquiridos, você pode trocá-los por um Crédito de Upload Os pontos são então retirados do seu Banco de Bónus e o crédito é adicionado ao seu montante total carregado.',
                'cost'=> 1000,
                'quantity' => 10737418240,
                'bonus_type'=> 1,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '25GB Uploaded',
                'description' => 'Com pontos de bônus suficientes adquiridos, você pode trocá-los por um Crédito de Upload. Os pontos são removidos do seu Banco de Bônus e o crédito é adicionado ao seu valor total de upload.',
                'cost'=> 2000,
                'quantity' => 26843545600,
                'bonus_type'=> 1,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '50GB Uploaded',
                'description' => 'Com pontos de bônus suficientes adquiridos, você poderá trocá-los por um crédito de upload. Os pontos são então retirados do seu Banco de Bónus e o crédito é adicionado ao seu montante total carregado.',
                'cost'=> 4000,
                'quantity' => 53687091200,
                'bonus_type'=> 1,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '100GB Uploaded',
                'description' => 'Com o suficiente pontos de bônus adquiridos, você pode trocá-los por um Crédito de Upload. Os pontos são removidos do seu Banco de Bônus e o crédito é adicionado ao seu total de upload.',
                'cost'=> 8000,
                'quantity' => 107374182400,
                'bonus_type'=> 1,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '520GB Uploaded',
                'description' => 'Com pontos de bônus suficientes, você pode trocá-los por um Crédito de Upload. Os pontos são removidos do seu Banco de Bônus e o crédito é adicionado ao seu valor total de upload.',
                'cost'=> 40000,
                'quantity' => 558345748480,
                'bonus_type'=> 1,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '1TB Uploaded',
                'description' => 'Com pontos de bônus suficientes adquiridos, você pode trocá-los por um Crédito de Upload. Os pontos são então removidos do seu Banco de Bónus e o crédito é adicionado ao seu montante total carregado.',
                'cost'=> 80000,
                'quantity' => 1099511627776,
                'bonus_type'=> 1,
                'bytes' => 2,
                'is_enabled' => true
            ],
            [
                'name' => '3 Convites',
                'description' => 'Com pontos de bônus suficientes, você pode trocá-los por alguns convites. Os pontos são removidos do seu Banco de Bônus e os convites são adicionados aos seus convites. unt.',
                'cost'=> 650,
                'quantity' => 3,
                'bonus_type'=> 4,
                'bytes' => null,
                'is_enabled' => true
            ],
            [
                'name' => 'Remover Aviso',
                'description' => 'Com pontos de bônus suficientes adquiridos... Então você foi desobediente... tsk tsk: P Sim, agora para o preço Low Low de apenas 1000 pontos você pode ter esse aviso tirado lol.!',
                'cost'=> 1000,
                'quantity' => 1000,
                'bonus_type'=> 3,
                'bytes' => null,
                'is_enabled' => true
            ],
            [
                'name' => '1GB Download Removal',
                'description' => 'Com pontos de bônus suficientes adquiridos, você pode trocá-los por um crédito de download Remoção: Os pontos são removidos do seu Banco de Bônus e o crédito de download é removido do seu total de downloads.',
                'cost'=> 150,
                'quantity' => 1073741824,
                'bonus_type'=> 0,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '2.5GB Download Removal',
                'description' => 'Com pontos de bônus suficientes adquiridos, você poderá trocá-los por uma Remoção de Crédito de Download. Os pontos serão removidos do seu Banco de Bônus e o crédito de download será removido do seu valor total de download.',
                'cost'=> 300,
                'quantity' => 2684354560,
                'bonus_type'=> 0,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '5GB Download Removal',
                'description' => 'Com pontos de bônus suficientes, você pode trocá-los por uma Remoção de Crédito de Download. Os pontos são removidos do seu Banco de Bônus e o crédito de download é removido do seu total de download.',
                'cost'=> 500,
                'quantity' => 5368709120,
                'bonus_type'=> 0,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => 'Freeleech por 1 ano',
                'description' => 'Com pontos de bônus suficientes adquiridos, você pode trocá-los por um ano para o Freelech. Os pontos são removidos do seu Banco de Bônus e a freeleech será ativada em sua conta.',
                'cost'=> 100000,
                'quantity' => 365,
                'bonus_type'=> 2,
                'bytes' => null,
                'is_enabled' => true
            ],
            [
                'name' => '+3 Slots',
                'description' => 'Com pontos de bônus suficientes adquiridos, você pode trocá-los por alguns Slots Freeleech. Os pontos são então removidos do seu Banco de Bônus e os slots são adicionados ao seu quantidade de slots grátis.',
                'cost'=> 1000,
                'quantity' => 3,
                'bonus_type'=> 5,
                'bytes' => null,
                'is_enabled' => true
            ],
        ];

        foreach ($bonus as $bon) {
            Bonus::create($bon);
        }
    }
}
