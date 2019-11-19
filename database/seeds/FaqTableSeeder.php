<?php

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faqs = [
            [
                'category_id' => '1',
                'question' => 'Afinal, o que é BitTorrent?',
                'answer' => 'O BitTorrent é um protocolo designado para a transferência de arquivos. É baseado na natureza P2P ou peer-to-peer (usuário a usuário). Ele trabalha de forma distribuída, ou seja, ao mesmo tempo em que você está fazendo um download, outros usuários estão pegando do seu micro as partes que você já baixou deste mesmo download. No BitTorrent, os arquivos originais são quebrados em pedaços pequenos, de poucos kbs, que podem ser unidos mais tarde para formar o arquivo final. Esse sistema de partilhamento optimiza ao máximo a velocidade da conexão, não sobrecarregando um servidor central. Assim, quanto mais usuários entrarem para descarregar um determinado arquivo, mais largura de banda se tornará disponível. Isto é possível porque a velocidade de download é proporcional à velocidade de upload. Ou seja, quanto mais usuários estiverem puxando partes de você, mais rápido será seu download. Pelo fato do bittorrent proporcionar que o usuário faça o upload ao mesmo tempo que o download, o início do processo de download é um pouco lento. Como no começo do download você não possui nenhuma parte do arquivo para compartilhar, sua velocidade fica muito reduzida. À medida que você tiver um pedaço maior do arquivo, mais pessoas se conectarão a você para baixar essas partes e, conseqüentemente, a velocidade do seu download aumentará.'
            ],
            [
                'category_id' => '2',
                'question' => 'Regras de Ratio! O que é ratio? E por que tem ratio mínimo?',
                'answer' => 'O ratio é a porcentagem que mostra quanto foi upado dividido por quanto foi baixado. Ou seja, se eu baixei 1.14 gb e depois disso upei 2.55 gb, então meu ratio será de 2.24,  que é a divisão de 2.55/1.14. O ratio é sempre o quanto upou dividido pelo quanto baixou. Os valores de "up" (quanto você já upou) e "down" (quanto você já baixou) podem ser encontrados no topo esquerdo da página, do lado do seu nick de usuário. Lá há uma seta para baixo indicando o quanto você já baixou(<i class="fa fa-arrow-down text-danger text-bold"></i>), e uma seta para cima indicando o quanto você já upou(<i class="fa fa-arrow-up text-success text-bold"></i>). Do lado do valor de "up", na terceira barra(<i class="fa fa-signal text-blue text-bold"></i>), você encontrará o seu ratio atual. Se houver dúvidas mesmo após as explicações, consulte algum admin do tracker ou então poste sua dúvida no local específico para tal, como neste tópico'
            ],
            [
                'category_id' => '2',
                'question' => 'Regras de Ratio Mínimo',
                'answer' => 'Implantamos essa regra de ratio mínimo porque, infelizmente, há pessoas que não compreendem o espírito do p2p. Apenas baixam e não ficam de seeder. Por isso, fizemos as regras do ratio, que estão explicadas abaixo.
                    Apenas os usuários com mais de 5GB baixados e pelo menos 1 torrent completo estão sujeitos às regras de ratio.
                    Se seu ratio ficar abaixo de 0.30, você receberá uma advertência. Enquanto estiver advertido, não poderá mais efetuar 
                    o download dos torrents. A única coisa que poderá fazer será baixar novamente os ".torrents" (não são os arquivos em si) que você já completou, e dessa forma entrar de seeder para recuperar o seu ratio.
                    Para que a advertência seja removida, é necessário que seu ratio atinja 0.40 ao menos. Após atingir esse valor, pode 
                    levar até 15 minutos para que o sistema remova a advertência.
                    ATENÇÃO: Se estiver advertido, poderá baixar APENAS os ".torrents" dos arquivos que já completou, e não os arquivos novamente. Os ".torrents" NÃO são os arquivos em si.
                    PS: Se o torrent NÃO tiver sido completado e você ficar advertido, NÃO poderá baixar nem os ".torrents".
                    DICA: Se for novo no tracker, NÃO baixe torrents maiores que 5gb, ou que a soma dos torrents ultrapasse 5gb. Isto evita o risco de ficar advertido antes de chegar a completar o torrent.'
            ],
            [
                'category_id' => '2',
                'question' => 'Fui advertido! Como faço pra me livrar da advertência?',
                'answer' => 'Os motivos para você ter recebido uma advertência são vários: 

                    (1) Você desrespeitou alguma regra.
                    (2) Você usou cheat ou tentou usar.
                    (3) Ocorreu um bug no sistema.
                    (4) Você está com o seu ratio abaixo de 0.5.
                    
                    Para se livrar da advertência, nos 3 primeiros casos, a única coisa a ser feita é mandar uma mp para alguém da Staff, explicar a situação e esperar ela ser resolvida e aceita. 
                    No último caso (4), você deverá elevar seu ratio para acima de 0.4. Para isso, leia as dicas abaixo: 
                    
                    Dicas para se livrar da advertência:
                    
                    Procure ficar de seeder o maior tempo possível quando terminar de baixar um torrent. Além de aumentar o seu ratio, você 
                    também ganhará pontos de karma;
                    Como citado acima, baixe novamente os ".torrents" que já completou. O sistema não impedirá que você entre de 
                    seeder nesses torrents;
                    Caso necessário, utilize seus pontos de karma para trocar por bônus de upload. A cada 1000 pontos de karma, você 
                    pode trocar por 1 gb de upload;
                    Contribua com o Wikisub e ganhe pontos de karma;
                    Baixe um Golden Torrent para recuperar seu ratio;
                    
                    ATENÇÃO: Para ver se seu ratio já alcançou 0.4, NÃO olhe na informação que aparece na barra de cima, pois seu ratio aparece arredondado. Para saber o valor real de seu ratio, vá nos detalhes do seu perfil.'
            ],
            [
                'category_id' => '2',
                'question' => 'O que significa Leecher e Seeder?',
                'answer' => '“Leecher” é como chamamos as pessoas que estão baixando algo, e “seeder” é como chamamos as pessoas que já baixaram e agora estão compartilhando, upando. Ou seja, uma mesma pessoa pode ser tanto leecher quanto seeder. Por exemplo, enquanto eu estiver baixando algum torrent, serei considerado(a) leecher, mas quando eu acabar de baixar e começar a upar, serei considerado(a) “seeder”. Tanto seu download quanto seu upload são contabilizados normalmente no estado leecher da mesma forma nos estados “leecher” e “seeder”. A única diferença é que em seed você ganha KPs.'
            ],
            [
                'category_id' => '2',
                'question' => 'O que são Pontos de Karma (conhecidos também como Karma Points ou KPs)?',
                'answer' => 'Pontos de Karma ou Karma Points (KPs) são pontos que os usuários ganham após ficarem de seeders nos torrents completos. Ganha-se 1 KP por cada torrent "completo" (Ou seja, não adianta baixar apenas alguns episódios de um torrent, pois o programa não irá considerá-lo como completo e não adicionará KPs a sua conta) que você ficar de seeder no período de 1 hora, no máximo de 5 torrents por hora. Ou seja, se eu baixar 2 torrents e ficar de seeder neles, após 1 hora eu receberei 2 Pontos de Karma, mas como o limite são 5 torrents, se eu baixar 8 ou 13 ou 30 torrents e ficar de seeder nestes, receberei apenas 5 KPs após 1 hora. Você pode ver quantos Pontos de Karma possui no topo da página, na barra que possui as suas informações. 
                    Outra maneira para se ganhar Karma Points é contribuindo para o Wikisub. Para maiores informações sobre como o Wikisub funciona, ou sobre como você também pode ajudar, leia a explicação no tópico abaixo. 
                    
                    Para que servem os Karma Points? 
                    
                    Primeira finalidade: Bônus de Upload!
                    
                    Os KPs servem para serem trocados por bônus de upload. A cada 1000 KPs, você pode trocar por 1 gb de bônus de upload que será somado ao seu upload total. Ou seja, se você tiver upado apenas 2 gb, mas possuir 1000 KPs, então você poderá trocá-los por 1 gb de upload a mais, aumentando assim seu total de upload de 2 gb para 3 gb.
                    Para ver seu ranking de Karma ou para trocar seus KPs por upload, clique aqui, ou então vá em "Perfil" na tabela ao lado, clique em "Karma" e você terá acesso ao ranking e à troca de KPs. Para trocar seus KPs por upload, clique em "Trocar Agora". 
                    
                    Segunda finalidade: Loteria!
                    
                    Para jogar na loteria, clique aqui, ou então vá em "Loteria" na tabela ao lado. Cada ticket que você quiser comprar lhe custará 10 KPs do seu total. Para comprar 1 ticket, coloque o número "1" na caixa "Comprar___Tickets" e finalize a compra clicando em "Comprar". Faça o mesmo procedimento caso queira comprar mais de 1 ticket. 
                    Se quiser saber quantos tickets já comprou e quantos ainda pode comprar, basta olhar as informações fornecidas no mesmo local. Além disso, você terá acesso também aos números de todos os tickets que possui até o momento. 
                    Para ver quantas pessoas estão participando da loteria e quantos tickets elas possuem, basta clicar aqui ou então ir em "Tickets Vendidos" para ter acesso a essas informações. 
                    Lembrando que o valor do prêmio é equivalente ao total de tickets vendidos, e que ele é adicionado automaticamente ao total de KPs do vencedor.
                    
                    Terceira finalidade: Black Jack (21)!
                    
                    Para jogar Black Jack, clique aqui ou então vá em "Blackjack" na tabela ao lado. O jogo Black Jack tem como objetivo fazer 21 pontos, ou chegar o mais próximo disso. É um jogo de apenas 2 pessoas, e não precisa esperar algum usuário para jogar. Leia as regras descritas, e faça a sua jogada. 
                    Para começar, clique em "Iniciar". Aparecerá uma carta, e a quantidade de pontos que você já possui. Para pegar mais uma carta, clique em "+ Carta!" e se quiser parar o jogo, clique em "Chega!". 
                    Após finalizar o jogo, você poderá receber dois tipos de mensagem. Poderá receber um aviso relatando a sua vitória ou a sua derrota perante algum usuário, assim como a soma ou a subtração de 50 KPs do seu total de acordo com o resultado obtido. Ou poderá receber uma mensagem relatando a falta de jogadores no momento. Caso isto ocorra, não se preocupe. No momento em que outro usuário finalizar sua jogada, você receberá outra mensagem com o resultado do jogo. 
                    Pense bem antes de entrar no jogo, pois não poderá voltar. Mesmo que tente retornar para a página anterior de seu navegador, um bug ocorrerá no sistema, e você perderá 50 KPs automaticamente. 
                    
                    Quarta finalidade: Doação!
                    
                    Você pode dar ou receber KPs através do sistema de doação de Karma Points. Clique aqui ou vá em "Perfil", "Karma" e escolha a opção nº2, "Enviar Karma". Você pode enviar 24, 69, 171, 500, 666 ou 1000 KPs para alguém. Basta escrever o nick da pessoa escolhida em "Usuário", escolher a quantidade de pontos a serem doados, e clicar em "Presentear". Com esse sistema, você pode doar KPs para alguém que já te ajudou anteriormente, para algum amigo, para alguém que está precisando, por perder uma aposta, ou pode também receber KPs pelos mesmos motivos, ou até por ganhar algum campeonato ou concurso. Ou seja, tem infinitas opções para se doar ou ganhar KPs.'
            ],
            [
                'category_id' => '2',
                'question' => 'O que são Golden Torrents?',
                'answer' => 'Golden Torrents são torrents que não contabilizam o download, mas apenas o upload, ao contrário dos torrents normais que contabilizam os dois. Ou seja, se eu baixar um Golden Torrent, meu ratio ficará intacto, sem sofrer alteração alguma, mudando apenas após o upload ser iniciado. 
                    Para que servem? 
                    
                    Os Golden Torrents servem para ajudar o ratio dos usuários. Ou seja, servem para os usuários, principalmente os que estão com ratio baixo, baixarem sem terem seus ratios diminuídos, podendo fazer apenas o upload destes torrents. Apenas o upload destes torrents são contabilizados. 
                    
                    Por quanto tempo duram? 
                    
                    Eles duram por tempo indeterminado. Podem durar alguns dias ou meses, tudo depende do tamanho do arquivo, disponibilidade de seeders e leechers e a health do torrent. Por isso, se estiver baixando um, fique sempre atento para não sofrer nenhuma advertência futura. 
                    
                    Como os torrents viram golden? 
                    
                    Os torrents podem virar golden quando:
                    Estão mortos ou com poucos seeders;
                    O torrent é muito grande;
                    Um fansub pede para que seu torrent seja golden;
                    
                    
                    ATENÇÃO: Se um torrent deixar de ser Golden enquanto você ainda estiver baixando, o download voltará a ser contado. Portanto, sempre verifique a página inicial para ver se o torrent ainda é golden ou não. Fique sempre atento para não prejudicar seu ratio e receber uma advertência.
                    
                    PS: Os Golden Torrents são aqueles que possuem um baú ao lado do nome.'
            ],
            [
                'category_id' => '2',
                'question' => 'O que é RAW?',
                'answer' => 'O termo “raw”, em inglês, significa “bruto”, no sentido de “sem lapidação”, aquilo que foi tirado da natureza e não sofreu nenhum tipo de tratamento. Em anime, o termo designa um arquivo em japonês sem legendas. O contrário de raw é anime ou mangá “subado”, ou seja, legendado (por fansubs no caso de anime ou scanlators no caso de mangá).'
            ],
            [
                'category_id' => '2',
                'question' => 'Tenho um fansub/scanlator e gostaria de cadastrá-lo. Como faço?',
                'answer' => 'Primeiramente, olhe a lista de fansubs e veja se ele já não está cadastrado. Outro meio de acessar esta lista é clicando em "fansubs" na tabela ao lado. 

                    Se o fansub não estiver cadastrado, então mande uma mp para alguém da staff com as seguintes informações: 
                    
                    *Nome do fansub/scanlator;
                    Site;
                    Servidor de irc;
                    Canal de irc;
                    Imagem do fansub;
                    Descrição;
                    
                    PS: *Lembrando que, na ausência das outras informações, apenas o nome do fansub/scanlator é necessário.'
            ],
            [
                'category_id' => '2',
                'question' => 'O que significa estar ou não "Conectável"?',
                'answer' => 'Estar "conectável" ou não estar é o status que mostra quando você pode se comunicar melhor com os outros usuários do tracker. Esta comunicação ocorre quando se faz o download e/ou o upload de algo do tracker. Ou seja, se estiver como "conectável", significa que sua conexão com os outros usuários do tracker irá melhorar, se conectando a mais seeders/leechers. No entanto, se estiver "não-conectável", não significa que não poderá baixar nada do tracker, mas apenas que não poderá se conectar a outros usuários também "não-conectáveis", somente com os "conectáveis". Usuários "não-conectáveis" nunca se conectam entre si. Contudo, você pode baixar/upar para usuários "não-conectáveis" através de algum "conectável", e é por isso que recomendamos desativar a opção de DHT de seu cliente torrent, para que assim haja troca entre os peers (outros usuários). 

                    O que estar "não-conectável" implica? 
                    Se um torrent tiver apenas um único seeder, e este for "não-conectável", assim como você, então não haverá troca de informações entre ambos. Dificilmente você conseguirá baixar este torrent, e se você for o único leecher, então o seeder também não conseguirá enviar nada. No entanto, se um torrent tiver vários seeders/leechers, a única coisa ruim que poderá acontecer é que nem os seeders nem os leechers uparão/baixarão à velocidade total de suas nets. 
                    
                    Onde eu vejo se estou ou não "conectável"? 
                    Você pode verificar se o seu status está ou não como "conectável" na hora em que estiver baixando ou upando algo. Nessa hora aparecerá o ícone de "não-conectável"() ou o de "conectável"(). Este ícone se encontra na barra superior, ao lado do escrito "Conectável:". 
                    
                    Se não estou conectável, como posso ficar? 
                    Vá em seu cliente torrent e verifique se a opção de alterar porta está desabilitada (Preferências > Conexão, caso use 
                    o cliente Utorrent).
                    Verifique se não tem nenhum software antivírus ou firewall instalado em seu computador. Se tiver, desative-os ou então
                    libere a porta que seu cliente torrent está usando. Ou ainda, dê prioridade para que seu cliente torrent se conecte a outros 
                    computadores e à internet.
                    Se tiver um modem roteador, precisará atribuir um IP estático pra sua conexão e fazer um Port Forward (liberar a 
                    porta do seu cliente torrent em seu modem), configurando o roteador pra redirecionar as portas de seu cliente para o IP que
                    você criou.
                    Veja se seu provedor não lhe oferece uma conexão com traffic shapping, ou seja, uma conexão limitada com a 
                    rede p2p (a rede que o torrent usa), dificultando assim sua conexão.
                    
                    Finalmente, para saber se sua porta está liberada, faça o teste de porta do utorrent:
                    
                    http://www.utorrent.com/testport.php?port=PORTA
                    
                    Basta trocar a palavra PORTA pela porta que seu cliente torrent está usando, não se esqueça que o cliente torrent tem que estar aberto quando fazer esse teste. 
                    
                    Se ainda estiver tendo problemas para configurar, entre neste site e procure a informação desejada.'
            ],
            [
                'category_id' => '2',
                'question' => 'O que é Wikisub?',
                'answer' => 'Antes de saber o que é o Wikisub, explicaremos o que é um fansub. 

                    Um FanSub, do termo em inglês Fan + Subtitle (Legenda), é um grupo que legenda animes do idioma japonês para o próprio idioma. Podem traduzir diretamente do áudio japonês, ou então das legendas prontas em inglês, espanhol, francês, etc. E normalmente suas legendas são "hardsub" (encodadas, grudadas no anime, impossível separar). 

                    O Wikisub é um fansub também, só que ao invés de possuir um grupo fixo para fazer as legendas, ele não possui nenhum integrante. Como assim? Quem faz todo o processo de legendagem é nada mais nada menos que qualquer usuário do tracker. Qualquer um pode se candidatar a exercer alguma função em algum projeto do Wikisub, basta apenas ter boa vontade. E além de ajudar a legendar, você ainda ganha KPs ao término do projeto. Outra diferença entre um fansub normal e o Wikisub é que no Wikisub as legendas normalmente são "softsub", ou seja, são separadas do vídeo e podem ser mudadas por qualquer um a qualquer hora. Para acessar os projetos do Wikisub, clique aqui ou então vá em "Wikisub", "Projetos" na tabela ao lado.'
            ],
            [
                'category_id' => '2',
                'question' => 'Para que serve o Chat? E o que é mIRC, IRC, e afins?',
                'answer' => 'O que é mIRC? 
                    mIRC é um programa gratuito que permite a comunicação entre servidores IRC (Internet Relay Chat). É como se fosse um programa para bate-papo, mas com muito mais funções. 
                    
                    E o Chat do SITE-? 
                    O Chat do SITE- é um mIRC em java. Utilizando ele você não precisará baixar nenhum script de mIRC, já que poderá se conectar ao canal do SITE- automaticamente. No entanto, este chat oferece pouquíssimas ferramentas, e é recomendado apenas àqueles que nunca usaram IRC antes. Quando se conectar ao canal, poderá conversar com outros usuários do SITE- como se estivesse em um bate-papo. Para acessar o "Chat", clique aqui, ou então vá em "Chat" na tabela ao lado. 
                    
                    Se quiser aprender mais sobre o funcionamento do mIRC, siga este tutorial.'
            ],
            [
                'category_id' => '2',
                'question' => 'O que é passkey? E pra que serve a opção de resetar passkey?',
                'answer' => 'Passkey é a senha que o tracker dá para o usuário quando este se registra. Cada um tem a sua e ela serve para o tracker receber seus dados e fazer a contagem do download e upload, entre outras coisas. Ou seja, o tracker se conecta a você por essa senha para atualizar qualquer modificação que haja na sua conta. Cada usuário tem a sua própria passkey e NÃO pode passá-la para ninguém, de forma alguma. 

                    Por que resetar a minha passkey? 
                    
                    Você tem que resetar sua passkey quando outra pessoa conseguir acesso a ela. Se alguém descobrir sua passkey e usá-la, tudo o que esta pessoa baixar será descontado no download do usuário que perdeu a passkey. Portanto, se desconfiar de algo, ou notar que sua quantia de download está aumentando sem você estar baixando absolutamente nada, pode ser que alguém tenha descoberto sua passkey e esteja usando-a para baixar na sua conta. 
                    Se isto ocorrer, vá em "Perfil", marque a opção "Resetar Passkey" e clique em "Alterar Perfil!". Pronto, sua passkey foi mudada. No entanto, para continuar fazendo seus downloads, baixe os .torrents novamente e abra-os em seu programa de torrent. 
                    
                    ATENÇÃO: NUNCA passe sua passkey para ninguém, em hipótese alguma. Se alguém lhe pedir para baixar um .torrent e mandar por email, NÃO o faça. No momento em que você baixa o .torrent do tracker, sua passkey fica "marcada" neste torrent automaticamente. Portanto, se baixar o .torrent e mandar para outra pessoa por email, ou msn, todo o download e upload feito pela pessoa que recebeu o .torrent será contabilizado na SUA conta.'
            ],
            [
                'category_id' => '2',
                'question' => 'Como fazer um SITEcontro?',
                'answer' => 'O que é um SITE-contro?? 

                    Um SITE-contro é um encontro entre os usuários daqui do SITE-.
                    Quer fazer um SITE-contro também? Então siga esses passos, é simples. 
                    O SITE-contro poderá ser feito tanto em eventos quanto em qualquer outro lugar;
                    Se for em um evento, favor criar um tópico no fórum sobre ele, caso ainda não exista, para assim chamar o pessoal do tracker também. Ou então mande uma mp com as informações do evento para a staff;
                    Tem que ter no MÍNIMO 2 pessoas, e estas devem ser usuários cadastrados no SITE-;
                    Se a pessoa não for cadastrada, está esperando o quê para convidá-la a se juntar a nós? xD
                    Tem que possuir obrigatoriamente uma plaquinha ou então uma folha de caderno ou qualquer outra coisa xD escrito SITE- Animes ou apenas SITE-;
                    Esta placa/folha deverá obrigatoriamente aparecer na foto, e esta deverá ser postada no tópico referente ao evento (caso não seja evento, favor criar um tópico com o título SITE-contro *cidade* (cidade em que o SITE-contro foi feito) para postar a foto ^^);
                    O SITE-contro poderá ser feito num bar, num shopping, numa rua, numa balada, numa loja, num evento, enfim, em qualquer lugar que puderem marcar o encontro ^^.
                    Tem que se divertir xD;
                    E como bônus, cada usuário do SITE- que aparecer na foto ganhará 250 KPs (mandar mp para a staff informando o tópico em que se encontra a foto e o nick dos usuários que nela aparecem).
                    
                    Dica: Falem em seus posts os dias em que irão ao evento, e marquem uma hora e um local de encontro para que todos os usuários possam se encontrar. No evento, façam algo chamativo para acharem os outros ou serem achados, como plaquinhas, anunciar no som local, algum tipo de camiseta, etc.
                    
                    Dica2: Se você souber de outro evento no Brasil e que não foi noticiado no tracker, favor mandar uma mp para alguém da staff, ou então crie você mesmo o tópico referente ao evento. Lembrando que tópicos de eventos podem sempre ser criados por qualquer usuário, mas sugerimos que não ultrapassem mais de 2 meses entre a data da criação do tópico e a data do evento.'
            ],
            [
                'category_id' => '2',
                'question' => 'Como fazer um tutorial?',
                'answer' => 'Um tutorial é um programa ou texto, contendo ou não imagens, que ensina passo a passo, didaticamente, como um aplicativo funciona. 

                    Como fazer um? 
                    Para fazer um tutorial, você tem que saber como o programa funciona e demonstrar passo a passo o seu funcionamento para aqueles que não sabem usá-lo. Sugerimos utilizar imagens para tornar o processo de aprendizado mais fácil. 
                    
                    Pra que fazer um? 
                    Para ajudar os outros usuários a usarem aquilo que não sabem, do mesmo modo como você também poderá ser ajudado. 
                    
                    PS: Para fazer um tutorial, use o ImageShack para upar as imagens e poste na parte de Tutoriais.'
            ],
            [
                'category_id' => '2',
                'question' => 'Meu IP é mostrado em alguma página?',
                'answer' => 'Não temos acesso ao seu IP navegando pelo site, somente quando você está baixando/enviando algum ".torrent".'
            ],
            [
                'category_id' => '2',
                'question' => 'Vocês podem deletar minha conta?',
                'answer' => 'Podemos. Contudo, só deletaremos caso ocorra algum problema.
                    Mesmo que você fique meses sem acessar o site, por algum motivo pessoal como escola, faculdade, trabalho entre outros, sua conta não será deletada.
                    Sua presença é muito imporante para nós.
                '
            ],
            [
                'category_id' => '2',
                'question' => 'Vocês podem renomear minha conta?',
                'answer' => 'Não!'
            ],
            [
                'category_id' => '2',
                'question' => 'Quais são as classes de usuários?',
                'answer' => '[b]User[/b] 
						   
                            Classe padrão dos usuários. 
                            
						    [b]Power User[/b] 
                               
                            Classe de quem upou mais de 25 Gb e tem o ratio maior que 1.00. 
                            
							Ajudou ou participou de promoções do SITE-.  
                            
							[b]Outros[/b] 
                               
                            Título Customizado. 
                            
							[b][color=#4040c0]Uploader[/color][/b] 
                               
                            Classe que tem o poder de upar torrents. 
                            
							[b][color=#A83838]Moderador[/color][/b] 
                               
                            Podem editar e deletar qualquer torrent, assim como moderar comentários, tópicos e desativar contas. 
                            
							[b][color=#A83838]Administrador[/color][/b] 
                               
                            Ajudam a manter a ordem no tracker em todos os sentidos. Podem modificar quase tudo.'
            ],
            [
                'category_id' => '2',
                'question' => 'Como funcionam essas classes?',
                'answer' => '[b]Power User[/b] 
					Deve ser um membro por no mínimo 4 semanas, ter upado no mínimo 25 Gb e ter um ratio igual ou maior que 1.05.
					A promoção é automática quando essas condições são alcançadas.
					Note que você perderá este status assim que seu ratio ficar abaixo de 0.95. 
					[b]Outros[/b]
					Conferido por moderadores.
					[b][color=#4040c0]Uploader[/color][/b]
					Dado pela staff para aqueles que querem ser uploaders. Note que qualquer usuário pode se tornar um, basta boa vontade.					 
					[b][color=#A83838]Moderador[/color][/b]
					Não nos peça, nós pediremos a você!'
            ],
            [
                'category_id' => '3',
                'question' => 'Porque eu recebo a mensagem "(porta xxxx está banida)"?',
                'answer' => 'Seu client está reportando ao tracker que usa uma das portas padrões do bittorrent (6881-6889) ou outra padrão de outro programa p2p.
                    O SITE- não permite que os clients utilizem portas associadas a outros protocolos p2p. A razão para isso é que se tornou comum os provedores de Internet limitarem ou bloquearem conexões através destas portas.'
            ],
            [
                'category_id' => '3',
                'question' => 'O tracker está OFF! O que eu faço?',
                'answer' => 'Se o tracker estiver off, não pare de baixar ou seedar. Não é porque ele está off que os downloads e uploads deixarão de funcionar. Quando o tracker voltar, todas as estatísticas serão atualizadas apropriadamente, inclusive o ratio.'
            ],
            [
                'category_id' => '3',
                'question' => 'Minha conta foi roubada ou utilizada incorretamente por terceiros! O que faço?',
                'answer' => 'A conta no SITE- é de total responsabilidade do usuário, portanto não reaveremos de forma alguma contas roubadas, nem retiraremos advertências supostamente ocasionadas por alguém que tenha utilizado sua conta incorretamente ou tenha violado alguma regra do tracker. Nestes casos, tenha especial cuidado ao fornecer seu login e senha para outras pessoas.
                    Essa regra vale também para sua passkey e os .torrents gerados pela sua conta.'
            ],
            [
                'category_id' => '3',
                'question' => 'Eu terminei ou cancelei um torrent. Por que ele ainda aparece em meu perfil?',
                'answer' => 'Alguns clientes não informam corretamente o tracker quando um torrent é finalizado ou cancelado. Neste caso, o tracker continuará esperando por alguma mensagem do cliente. Apenas ignore isto. Hora ou outra a mensagem sumirá de seu perfil.'
            ],
            [
                'category_id' => '3',
                'question' => 'Porque mostra que estou baixando/upando duas ou mais vezes os meus torrent?',
                'answer' => 'Podem existir duas explicações:

                    (1) Você fechou seu cliente torrent incorretamente ou suas conexões caíram e formaram "torrents fantasmas".
                    (2) Sua passkey ou login e senha foram roubados e outra pessoa esta baixando em sua conta.
                    
                    Para se livrar desses torrent duplicados é simples, bastar esperar um pouco até que eles sumam, eles devem sumir em cerca de no máximo 30 minutos, nesse tempo é aconselhável que deixe seu cliente torrent fechado, para evitar criar mais e mais "torrent fantasmas", caso demore mais que 30 minutos para esses torrent saírem, tente verificar seu ratio, valores de upload e download e espere cerca de 1 hora, se houver alterações em nesses valores mesmo com seu cliente torrent fechado, você deve ter tido sua passkey ou login e senha roubados, por isso recomendamos que altere sua senha e resete sua passkey em seu perfil e sugerimos que entre em contato com algum administrador caso haja suspeita deste segundo caso.'
            ],
            [
                'category_id' => '3',
                'question' => 'O que é esta mensagem: "PIECE XXX FAILED HASH CHECK"?',
                'answer' => 'Quando um torrent é disponibilizado para seed pela primeira vez, é crido um hash desse torrent completo, ele também é segmentado e cria-se um hash de cada um dos segmentos. Cada vez que o torrent baixa um segmento, ele checa o hash do segmento com o original. Se não for compatível, ele descarta e tenta baixar novamente. É normal o hash falhar, não é algo que se precise se preocupar; o melhor é deixar o torrent baixando normalmente e ignorar esse erro, possivelmente o programa vai passar a ignorar a origem dos pacotes corrompidos e baixar de outra fonte se começar a baixar segmentos corrompidos demais da mesma fonte. 

                    A chance de vir algum arquivo corrompido e ter que baixar o torrent novamente é nula, pois se o arquivo original estiver funcionando, ele gera o hash correto e o download vai ser bem sucedido. Só vai chegar corrompido se quem disponibilizou o arquivo pela primeira vez já upou um torrent com o arquivo corrompido desde o começo.'
            ],
            [
                'category_id' => '4',
                'question' => 'Como eu coloco um avatar no meu profile?',
                'answer' => 'Primeiro, encontre uma imagem que você goste e que esteja de acordo com as regras. Encontre um lugar para hospedá-la, como o ImageShack. Agora, no site do ImageShack, copie a URL informada no campo "Direct link to image" e cole no campo "URL do Avatar" que se encontra no seu perfil.'
            ],
            [
                'category_id' => '4',
                'question' => 'Como eu coloco uma assinatura no Fórum?',
                'answer' => 'Sua assinatura pode conter uma ou mais imagens, sendo elas normais ou gifs animados, ou pode ter apenas algo escrito. Esta assinatura aparecerá embaixo das suas mensagens quando você postar algo no "Fórum". 

                    Primeiramente, encontre uma imagem que você goste e que esteja de acordo com as regras. Encontre um lugar para hospedá-la, como o ImageShack. Agora, no site do ImageShack, copie a URL informada no campo "Direct link to image" e cole no campo "Assinatura". No entanto, esta URL que você copiou e colou tem que estar entre as TAGs [img] e [/img]. Ou seja, coloque [img] antes da URL, e [/img] após a URL, sem nenhum espaço. Exemplo: [img]URL[/img].
                    Depois de feito isto, clique em "Enviar". 
                    
                    Se não quiser colocar nenhuma imagem, mas apenas algo escrito, como uma palavra, ou uma frase, apenas escreva algo neste mesmo campo "Assinatura". Para mudar alguma coisa na sua frase, você terá que usar códigos BB. Para deixar a frase em negrito, escreva ela entre as TAGs [b] e [/b]. Para mudar a cor, escreva entre [color=??] e [/color], onde o ?? é a cor em inglês (blue, red, green, etc). Para se usar os dois ao mesmo tempo, ou seja, para mudar a cor e deixar também em negrito, escreva a frase entre [b][color=??] e [/color][/b]. Depois de feito isto, clique em "Enviar". 
                    
                    Lembrando que para chegar nesse campo "Assinatura", basta ir em "Perfil", "Perfil do Fórum" e clicar na frase "Para alterar seu perfil no fórum, clique aqui".'
            ],
            [
                'category_id' => '4',
                'question' => 'Como eu coloco um title (nomezinho) embaixo do meu nick?',
                'answer' => 'Ao contrário de outros trackers, você não pode escolher/comprar seu próprio title. Somente a staff pode escolher e colocar titles, e eles normalmente são bem zuados. Fazemos isso porque é mais engraçado e já virou um diferencial nosso. Se ainda quiser correr o risco de ter um title zuado, poste neste tópico. 
                    No entanto, ainda há a possibilidade de colocarmos um title em você mesmo que não tenha pedido. Caso não queira, mande uma mp para a staff ou poste no mesmo tópico acima pedindo para retirar. 
                    
                    PS: Às vezes podemos demorar um pouco para colocar o tilte, já que é algo que demanda criatividade. Portanto, não fique chateado se colocarmos titles em outros usuários e não em você. Um hora ou outra você o terá. Nós prometemos.'
            ],
            [
                'category_id' => '5',
                'question' => 'Como eu baixo os arquivos?',
                'answer' => 'Os arquivos existentes aqui no tracker são chamados de "torrents". Quando você entra na página de algum anime, longa, OVA, etc, para baixar, você não estará baixando o arquivo em si, mas sim o arquivo ".torrent". Ou seja, você não estará baixando o arquivo pronto, mas sim um pacote que irá baixar o arquivo pronto. Portanto, para baixar algo, você precisará ter, primeiramente, um cliente torrent, que é o programa onde você abrirá os arquivos ".torrent" baixados daqui do tracker.

                    Dentre os clientes mais conhecidos, e melhores aceitos pelo tracker, estão:
                    
                    • Azureus
                    • Utorrent
                    
                    Você poderá usar outros clientes, mas recomendamos um desses 2. Principalmente o Utorrent, que é mais simples, não dá problemas e é o mais usado por todos.
                    
                    Para baixá-los, entre em seus respectivos sites.
                    
                    • Azureus -> www.azureus.com
                    • Utorrent -> www.utorrent.com
                    
                    Após baixar o cliente torrent, você precisará ter o arquivo ".torrent". Este arquivo você baixará daqui do tracker e abrirá no cliente torrent para que o download comece. 
                    
                    ATENÇÃO: O uso de outros programas de torrent que não estes dois citados não é aconselhável por nós. Os outros programas normalmente bugam as estatísticas na hora de mandar as informações para o tracker. A consequência disso é a possibilidade de se perder Mbs de upload e/ou download, ou seja, você pode upar 800 Mbs e somente contabilizar 100 Mbs no tracker, por exemplo. Os 700 Mbs restantes se perdem para sempre.'
            ],
            [
                'category_id' => '5',
                'question' => 'Por que meus downloads às vezes param em 99%?',
                'answer' => 'Quanto mais pedaços do download você tiver, mais difícil será encontrar usuários que possuam os pedaços que você procura. Por isso os downloads diminuem de velocidade ou até param quando estão pertos de terminar. Apenas seja paciente, pois mais cedo ou mais tarde o download irá terminar.'
            ],
            [
                'category_id' => '5',
                'question' => 'Estava baixando um torrent, mas ele desapareceu. Por quê?',
                'answer' => 'Para um torrent ter desaparecido, 2 coisas podem ter ocorrido:

                    (1) O torrent não estava de acordo com as regras do tracker.
                    (2) O Uploader pode ter deletado o torrent por causa de algum problema. 
                    Ele provavelmente upará o torrent de novo, desta vez com o erro consertado.'
            ],
            [
                'category_id' => '5',
                'question' => 'Como eu posso melhorar a minha velocidade de download?',
                'answer' => 'Não baixe imediatamente novos torrents.

                    A velocidade de download depende da relação leechers/seeders. Torrents recém upados e/ou populares tendem a ter muitos leechers quando acabam de ser upados. Isto leva o torrent a ter várias pessoas baixando e pouquíssimas upando. Para tanto, a velocidade de download fica baixa. A melhor coisa a se fazer é baixar o torrent quando a relação leechers/seeders estiver equilibrada, ou seja, com mais ou menos a mesma quantidade de usuários nos dois lados. É melhor devido ao fato de que você poderá baixar o torrent mais rápido e também poderá upá-lo bastante, já que se você esperar muito e tiver muitos seeders no torrent e poucos leechers, a quantidade que você irá upar será muito pequena.'
            ],
            [
                'category_id' => '6',
                'question' => 'Por que eu não posso upar torrents?',
                'answer' => 'Somente usuários autorizados (Uploaders) têm permissão para upar torrents.'
            ],
            [
                'category_id' => '6',
                'question' => 'Como eu fico de seeder?',
                'answer' => 'Quando o download do torrent que você estiver baixando for completado, você poderá ficar de seeder. Para isso, você tem que deixar o que baixou do jeito que está, sem mudar o arquivo de lugar, ou renomear. Para ser seeder, basta deixar o seu programa de Bittorrent aberto depois que o download acabar, pois após o término deste download, o torrent entrará no modo de seeder automaticamente. Qualquer dúvida, leia este tutorial.'
            ],
            [
                'category_id' => '6',
                'question' => 'Como eu posso melhorar a minha velocidade de upload?',
                'answer' => 'Para melhorar a sua velocidade de upload, você tem que desabilitar alguns itens no seu cliente torrent.

                Desabilite a opção de "Initial Seeding" do Utorrent e a opção "Super Seeding" dos outros clientes, pois, ao contrário do
                que muitos pensam, essas opções não ajudam na velocidade do upload, só atrapalham. Se os outros clientes também tiverem essa opção ou alguma parecida, desabilite-a.
                Desabilite a opção DHT em qualquer cliente que possuir, pois não funciona em tracker privado, apenas em tracker público. 
                O DHT habilitado faz com que alguns Mbs do seu upload se percam e não sejam contabilizados no seu ratio.'
            ],
            [
                'category_id' => '7',
                'question' => 'Que critérios devo seguir para ser um Uploader?',
                'answer' => 'Para se tornar um uploader, você precisará seguir algumas regras. Elas são:

                    **Ter um ratio mínimo de 1.0;
                    **Ter upado no mínimo 20Gb;
                    Upar arquivos nos formatos aceitos pelo tracker (rm, rmvb, wmv e outros formatos de baixa qualidade estão proibidos), pois prezamos a qualidade, 
                    e tais formatos são de qualidade inferior. E mais, reencodes são PROIBIDOS;
                    Upar apenas materiais relacionados à cultura japonesa, com algumas exceções a materiais asiáticos (no caso das exceções, entrar em contato com a staff);
                    Não upar materiais que sejam licenciados em DVD ou Mangá aqui no Brasil (a não ser que abandonem o projeto no meio, sendo impossível comprar a continuação);
                    Não upar jogos, OSTs de jogos, seriais, cracks, alguma forma de cheat, e afins;
                    Upar APENAS materiais legendados em PORTUGUÊS. Não aceitamos legendas em outros idiomas, a não ser 
                    as legendas do Wikisub, e em caso de materiais raros (ou seja, materiais -animes, tokusatsu, live, etc - muito difíceis de serem achados. Neste caso, favor entrar em contato com a staff);
                    Materias dublados são permitidos desde que não sejam licenciados em DVD no Brasil;
                    Não upar materiais diferentes em um único torrent. Ex: Um torrent de Elfen Lied OVA + Chrono Trigger OVA;
                    Não upar mais que 2 OSTs seguidas;
                    Upar apenas materiais que sejam autorizados pelos Fansubs ou pelos Scanlators 
                    (você pode encontrar a lista de Subs e Scans autorizados aqui);
                    Não upar OST"s compactadas em winzip, winrar ou qualquer outro programa similar. Já os mangás
                    podem ser ou não compactados;
                    **Se o anime tiver sido finalizado pelo fansub, favor upá-lo em apenas 1 pack. Não há necessidade de upar torrents muito 
                    fragmentados, ainda mais se for de episódio em episódio. Visamos, com isso, torrents com o máximo possível de arquivos, ou como completo ou como pack. Apenas lançamentos poderão ser upados de episódio em episódio;
                    **Upar pelo menos 1 torrent dentro do período de 3 meses;
                    **Colocar foto no torrent, e na parte da descrição, pôr o nome do anime, o número total 
                    de episódios e a review em PORTUGUÊS (descrição do anime), no MÍNIMO;
                    **Avisar nas informações do torrent se faz parte ou não do Fansub ou Scanlator responsável pelo torrent a ser upado;
                    Ficar de seeder no torrent que upar tempo suficiente para que outros usuários 
                    possam terminar de baixar e, assim, entrar de seeder também. Aquele que deixar seus torrents morrerem por não
                    ter ficado tempo suficiente de seeder, receberá 1 aviso. Na terceira vez, retiraremos o status;
                    Ter consciência de sua própria conexão, e não sair upando vários torrents de uma só vez sem nem ao menos possuir banda 
                    suficiente para alimentar todos eles. Os uploaders que se encontrarem nesta situação, favor verificarem se suas conexões suportam a quantidade de uploads que estão sendo feitos;
                    Procurar saber se o torrent a ser upado já não existe no tracker para que não haja duplicação dos torrents. Caso isso ocorra, 
                    a Staff fará um balanceamento entre os dois torrents existentes, e deletará aquele que possuir uma menor utilidade, como por exemplo o torrent que possuír menos seeders, ou que estiver morto, assim como com menos arquivos, e outras situações a serem analisadas caso a caso;
                    
                    Se puder seguir tais critérios, não hesite em pedir para algum membro da Staff para se tornar um Uploader também. 
                    
                    Ou então deixe uma mensagem aqui ou aqui. 
                    
                    Após se tornar uploader, siga este tutorial para aprender a upar um torrent. 
                    
                    PS1: O descumprimento das regras resultará, no máximo, em 2 avisos. No terceiro aviso, retiraremos o status.
                    
                    PS2: Apenas as regras que possuem ** não se aplicam obrigatoriamente aos uploaders membros de Fansubs e Scanlators. Todas as outras deverão ser seguidas independentemente do uploader ser ou não de Fansub. 
                    
                    PS3: Os uploaders já existentes terão que se encaixar nas novas regras. Se não tiverem ratio mínimo de 1.0, passem a ter. E se seus animes não tiverem foto, nome, número de episódios e review, edite-os e coloque tais informações. 
                    
                    PS4: Uploaders NÃO estão isentos das regras de ratio. Portanto, se estiver advertido, não nos peça para se tornar uploader com a ilusão de que a advertência será retirada.'
            ],
            [
                'category_id' => '7',
                'question' => 'Torrents Permitidos',
                'answer' => 'Seguindo as regras dos uploaders acima, os torrents permitidos são: 

                    Hentai;
                    Live;
                    Longa;
                    Mangá;
                    Música;
                    OVA;
                    RAW;
                    Série;
                    Tokusatsu;
                    Dorama;
                    OSTs de Animes;
                    Artbooks;
                    One-Shots;
                    Filmes Asiáticos;
                    PVs; -> Os PVs podem ser ou não legendados. Serão unicamente relacionados a animes e afins, não podendo ser apenas de músicas cantadas por japoneses. Eles serão APENAS dos animes/filmes/tokus/etc que JÁ existirem no tracker.
                    Se o PV for upado e o anime não existir, ele será deletado. Ou seja, o anime/filme/dorama/toku/etc tem que ser upado obrigatoriamente ANTES do PV.
                    Shows; -> Apenas shows relacionados a animes e de cantores japoneses que ocorrerem aqui no Brasil. Por exemplo o show dos cantores japoneses no Anime Friends, que teve o nome de Super Friends Spirits.
                    Documentários com relação à cultura japonesa; -> Desde que não sejam licenciados.
                    
                    PS: Se quiser upar algum torrent que não se encaixa em nenhuma categoria acima, favor mandar uma mp para a staff para averiguação.'
            ],
            [
                'category_id' => '7',
                'question' => 'Torrents Proibidos',
                'answer' => 'Seguindo as regras dos uploaders acima, os torrents proibidos são: 

                    Jogos;
                    Seriais;
                    Cracks;
                    Programas;
                    OSTs de Jogos;
                    Cutscenes de Jogos;
                    **AMVs;
                    **Capas de DVDs;
                    Discografias de bandas;
                    Filmes Pornôs;
                    
                    PS: Se quiser upar algum torrent que não se encaixa em nenhuma categoria acima, favor mandar uma mp para a staff para averiguação. 
                    PS2: As categorias com ** só serão aceitas se não forem upadas "sozinhas". Se houver um torrent com um anime + amv/capas, este não será deletado.'
            ],
            [
                'category_id' => '8',
                'question' => 'Programa desatulizado',
                'answer' => 'Utilize sempre versão mais recente do uTorrent, Vuze, BitTorrent, etc.
                    Ou as 3 últimas versões do programa que você já está acostumado a ulizar.
                    Durante o desenvolvimento e testes foram detectadas algumas falhas como perda de conexão, pacote, até mesmo perca de dados.
                    Usando as versões mais recentes você não terá esses problemas.
                '
            ],
            [
                'category_id' => '8',
                'question' => 'Fake upload',
                'answer' => 'Nosso sistema salva registro de programas que enviam informações de FAKE UPLOAD ao detectarmos isso, Só aguarde.'
            ],
            [
                'category_id' => '9',
                'question' => 'Você pode tentar:',
                'answer' => 'Poste suas dúvidas na parte de Dúvidas e Sugestões do Fórum ou clique aqui e mande uma mp (mensagem pessoal) para alguém da Staff. Para mandar uma mp, basta clicar no envelope que se encontra ao lado direito do nome do membro e escrever a mensagem a ser enviada. A Staff e/ou os próprios usuários ajudarão a resolver seus problemas. Mas antes de perguntar algo, siga as sugestões abaixo:

                    Antes de postar no Fórum, certifique-se de que a resposta para o seu problema realmente não se encontra aqui no FAQ, 
                    nem nos tópicos existentes no fórum. Para tanto, leia os tópicos antes de postar sua dúvida, pois neles poderá encontrar a solução.
                    Ajude-nos e ajudaremos você. Não diga apenas "Isto não funciona!". Relate-nos todos os detalhes do problema para
                    que ele possa ser resolvido sem delongas.
                    E seja educado(a). Peça ajuda com educação, sem ser grosseiro(a) e sem xingar, pois deste modo dificilmente receberá
                    a ajuda de alguém.'
            ]
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
