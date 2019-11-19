<?php

use App\Models\Rule;
use Illuminate\Database\Seeder;

class RulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rules = [
            [
                'name' => 'Regras gerais',
                'description' => '
                    - Respeite todos os membros!
                    - Você só receberá 5 [b]avisos[/b]! 3 [b]suspenções[/b] de [b]30[/b], [b]60[/b] e [b]90[/b] dias. Depois disso, é tchau!
                    - Não desafie os desejos manifestados pelos administradores e moderadores!
                    - Não solicite nada relacionado a material licenciado. Esse conteúdo é proibido no tracker, sem exceções. Valorize o trabalho das empresas que estão investindo neste mercado.
                    - Nenhum comportamento agressivo, inflamação, difamação, publicidade, solicitação, imagens e textos que incluam racismo / nudez / sexismo / religião ou linguagem obscena.
                    - Nenhuma consulta sobre ranks, se acharmos que você merece, você será promovido.'
            ],
            [
                'name' => 'Regras do Fórum',
                'description' => '
                    - Nenhum comportamento agressivo ou inflamação ou difamação.
                    - Não há lixo dos tópicos de outras pessoas (por exemplo, SPAM).
                    - Não há links para sites de warez ou crack.
                    - Sem serial, senhas, rastreadores ou sites lucrativos.
                    - Nenhum pedido se a posagem tiver mais de 7 dias.
                    - Sem repitição... (Todos tópicos repitidos serão excluídos).
                    - Nenhuma postagem dupla. Se você deseja postar novamente, e o seu é o último post no tópico, por favor use a função EDITAR, ao invés de um post duplo.
                    - Por favor, certifique-se de todas as perguntas são postadas na seção correta!
                    - Sem publicidade.
                    - É permitido mencionar outros sites, desde que você não os promova
                    - Nenhum pedido de downloads.
                    - Não há perguntas sobre quando qualquer coisa será enviada.
                    - Não serão postadas fotos com racismo / nudez / sexismo / religião no fórum. [Se você realmente precisar postá-lo, basta postar o link com uma tag ** 18 + ** ao redor dele.]
                    - Use a pesquisa antes de postar qualquer coisa, o seu segmento será bloqueado se você não fizer isso.'
            ],
            [
                'name' => 'Regras de moderação',
                'description' => '
                    - A regra mais importante! Use seu melhor julgamento!
                    - Não desafie outro staff em público, envie um PM ou faça um post no "Site admin".
                    - Seja tolerante! dar ao(s) usuário(s) a chance de se reformar.
                    - Não aja prematuramente, deixe os usuários cometerem seu erro e, então, corrija-os.
                    - Tente corrigir qualquer "off topic" ao invés de fechar o tópico.
                    - Mova os tópicos em vez de bloqueá-los / excluí-los.
                    - Seja tolerante ao moderar a seção Chit-chat. (dê-lhes alguma folga)
                    - Se você bloquear um tópico, dê uma breve explicação do motivo pelo qual você está bloqueando.
                    - Antes de banir um usuário, envie-lhe uma PM e, se responderem, coloque-os em uma avaliação de duas semanas.
                    - Não banir um usuário até que ele ou ela seja membro por pelo menos 4 semanas.
                    - Sempre informe um motivo (na caixa de comentários do usuário) sobre por que o usuário está sendo banido.'
            ],
            [
                'name' => 'Regras de download',
                'description' => '
                    - Mantenha seu ratio global igual ou superior a 0,5 em todos os momentos!
                    - Comprometa-se em compartilhar pelo menos a mesma quantidade de dados que você recebeu.
                    - Não é permitido fazer batota, se nós ou nosso sistema descobrirmos que você receberá uma proibição imediata.
                    - DHT e PEX (Peer Exchange) devem ser desativados em todos os clientes.
                    - Clientes banidos não são permitidos. Consulte o FAQ.'
            ],
            [
                'name' => 'Diretrizes do Fórum',
                'description' => '
                    - Aconselhamos que você não escreva detalhes de contato. endereço, endereço de e-mail ou IP no fórum ou no seu perfil para sua própria privacidade.
                    - Sempre que você tiver algo para adicionar e não tiver sido feito um novo post, use a função de edição. Isso significa que não há colisão também.
                    - Postar no CAPS LOCK é muitas vezes tomado como gritando e, portanto, não é apreciado. Também não está postando posts inteiros em um tamanho muito grande.
                    - Por favor, assegure-se de que todos os tópicos foram colocados na seção correta!'
            ],
            [
                'name' => 'Regras Avatar',
                'description' => '
                    - Não use nenhum avatar que possa fazer com que os membros o confundam como membro da equipe.
                    - Seu avatar não pode incluir racismo / nudez / sexismo / religião ou algo que seja facilmente considerado ofensa. [Se estiver em dúvida se algo é apropriado ou não fique à vontade para enviar uma mensagem a um staff.]
                    - Tamanhos máximos são 200px x 300px.'
            ]
        ];

        foreach ($rules as $rule) {
            Rule::create($rule);
        }
    }
}
