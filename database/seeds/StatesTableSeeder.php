<?php

use App\Models\State;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['name' => 'Acre', 'uf' => 'AC', 'flag' => 'ac.png'],
            ['name' => 'Alagoas', 'uf' => 'AL', 'flag' => 'al.png'],
            ['name' => 'Amapá', 'uf' => 'AP', 'flag' => 'ap.png'],
            ['name' => 'Amazonas', 'uf' => 'AM', 'flag' => 'am.png'],
            ['name' => 'Bahia', 'uf' => 'BA', 'flag' => 'ba.png'],
            ['name' => 'Ceará', 'uf' => 'CE', 'flag' => 'ce.png'],
            ['name' => 'Distrito Federal', 'uf' => 'DF', 'flag' => 'df.png'],
            ['name' => 'Espírito Santo', 'uf' => 'ES', 'flag' => 'es.png'],
            ['name' => 'Goiás', 'uf' => 'GO', 'flag' => 'go.png'],
            ['name' => 'Maranhão', 'uf' => 'MA', 'flag' => 'ma.png'],
            ['name' => 'Mato Grosso', 'uf' => 'MT', 'flag' => 'mt.png'],
            ['name' => 'Mato Grosso do Sul', 'uf' => 'MS', 'flag' => 'ms.png'],
            ['name' => 'Minas Gerais', 'uf' => 'MG', 'flag' => 'mg.png'],
            ['name' => 'Pará', 'uf' => 'PA', 'flag' => 'pa.png'],
            ['name' => 'Paraíba', 'uf' => 'PB', 'flag' => 'pb.png'],
            ['name' => 'Paraná', 'uf' => 'PR', 'flag' => 'pr.png'],
            ['name' => 'Pernambuco', 'uf' => 'PE', 'flag' => 'pe.png'],
            ['name' => 'Piauí', 'uf' => 'PI', 'flag' => 'pi.png'],
            ['name' => 'Rio de Janeiro', 'uf' => 'RJ', 'flag' => 'rj.png'],
            ['name' => 'Rio Grande do Norte', 'uf' => 'RN', 'flag' => 'rn.png'],
            ['name' => 'Rio Grande do Sul', 'uf' => 'RS', 'flag' => 'rs.png'],
            ['name' => 'Rondônia', 'uf' => 'RO', 'flag' => 'ro.png'],
            ['name' => 'Roraima', 'uf' => 'RR', 'flag' => 'rr.png'],
            ['name' => 'Santa Catarina', 'uf' => 'SC', 'flag' => 'sc.png'],
            ['name' => 'São Paulo', 'uf' => 'SP', 'flag' => 'sp.png'],
            ['name' => 'Sergipe', 'uf' => 'SE', 'flag' => 'se.png'],
            ['name' => 'Tocantins', 'uf' => 'TO', 'flag' => 'to.png']
        ];

        foreach ($states as $state) {
            State::create($state);
        }
    }
}
