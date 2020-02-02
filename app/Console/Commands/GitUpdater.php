<?php

namespace App\Console\Commands;

use App\Traits\ConsoleTools;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Style\SymfonyStyle;

class GitUpdater extends Command
{
    use ConsoleTools;

    /**
     * The copy command.
     */
    protected $copy_command = 'cp -Rfp';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'git:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executa os comandos necessários para atualizar o site usando o Git';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->input = new ArgvInput();
        $this->output = new ConsoleOutput();

        $this->io = new SymfonyStyle($this->input, $this->output);

        $this->info('
        ***************************
        * Git Updater v2.5 Beta   *
        ***************************
        ');

        $this->line('<fg=cyan>
        THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" 
        
        IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, 
        SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE 
        GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) EVEN IF ADVISED OF THE POSSIBILITY 
        OF SUCH DAMAGE.
        
        COM ISSO, VOCÊ PODE SER GARANTIDO QUE SUA BASE DE DADOS NÃO SERÁ ALTERADA.
        
        <fg=red>AO PROCEDER QUE VOCÊ CONCORDA COM A ISENÇÃO DE RESPONSABILIDADE ACIMA! USE POR SUA CONTA E RISCO!</>
        </>');

        if (!$this->io->confirm('Gostaria de continuar?', false)) {
            $this->line('<fg=red>Cancelado...</>');
            die();
        }

        $this->io->writeln('Pressione CTRL + C QUALQUER MOMENTO para cancelar! O cancelamento pode levar a resultados inesperados!');

        sleep(1);

        $this->update();

        $this->white('Relate quaisquer erros ou problemas.');

        $this->done();
    }

    private function update()
    {
        $updating = $this->checkForUpdates();

        if (count($updating) > 0) {
            $this->alertDanger('Atualizações encontradas');

            $this->cyan('Arquivos que precisam ser atualizados:');
            $this->io->listing($updating);

            if ($this->io->confirm('Start the update process', false)) {
                $this->call('down', [
                    '--message' => 'Currently Updating',
                    '--retry'   => '300',
                ]);

                $this->process('git add .');

                $paths = $this->paths();

                $this->backup($paths);

                $this->header('Reseting Repository');

                $this->commands([
                    'git fetch origin',
                    'git reset --hard origin/master',
                ]);

                $this->restore($paths);

                $conflicts = array_intersect($updating, $paths);
                if (count($conflicts) > 0) {
                    $this->red('Existem alguns arquivos que não foram atualizados devido a conflitos.');
                    $this->red('Vamos orientá-lo na atualização desses arquivos agora.');

                    $this->manualUpdate($conflicts);
                }

                $this->clearCache();

                if ($this->io->confirm('Atualizar novos pacotes (composer install)', true)) {
                    $this->composer();
                }

                $this->setCache();

                $this->permissions();

                $this->header('Trazendo site de volta ao ar');
                $this->call('up');
            } else {
                $this->alertDanger('Atualização interrompida');
                die();
            }
        } else {
            $this->alertSuccess('Nenhuma atualização disponível encontrada');
        }
    }

    private function checkForUpdates()
    {
        $this->header('Verificando atualizações');

        $this->process('git fetch origin');
        $process = $this->process('git diff ..origin/master --name-only');
        $updating = array_filter(explode("\n", $process->getOutput()), 'strlen');

        $this->done();

        return $updating;
    }

    private function manualUpdate($updating)
    {
        $this->alertInfo('Manual Update');
        $this->red('A atualização fará com que você perca as alterações que você possa ter feito no arquivo!');

        foreach ($updating as $file) {
            if ($this->io->confirm("Update $file", true)) {
                $this->updateFile($file);
            }
        }

        $this->done();
    }

    private function updateFile($file)
    {
        $this->process("git checkout origin/master -- $file");
    }

    private function backup(array $paths)
    {
        $this->header('Fazendo backup de arquivos');

        $this->commands([
            'rm -rf '.storage_path('gitupdate'),
            'mkdir '.storage_path('gitupdate'),
        ], true);

        foreach ($paths as $path) {
            $this->validatePath($path);
            $this->createBackupPath($path);
            $this->process($this->copy_command.' '.base_path($path).' '.storage_path('gitupdate').'/'.$path);
        }

        $this->done();
    }

    private function restore(array $paths)
    {
        $this->header('Restaurando backups');

        foreach ($paths as $path) {
            $to = Str::replaceLast('/.', '', base_path(dirname($path)));
            $from = storage_path('gitupdate').'/'.$path;

            if (is_dir($from)) {
                $to .= '/'.basename($from).'/';
                $from .= '/*';
            }

            $this->process("$this->copy_command $from $to");
        }

        $this->commands([
            'git add .',
            'git checkout origin/master -- composer.lock',
        ]);
    }

    private function composer()
    {
        $this->header('Atualizar pacotes do composer');

        $this->commands([
            'composer update',
            'composer dump-autoload',
        ]);

        $this->done();
    }

    private function clearCache()
    {
        $this->header('Limpando o cache');
        $this->call('haitou:clear-all-cache');
        $this->done();
    }

    private function setCache()
    {
        $this->header('Configurando o cache');
        $this->call('haitou:set-all-cache');
        $this->done();
    }

    private function permissions()
    {
        $this->header('Atualizando permissões');
        $this->process('chown -R www-data: storage bootstrap public config');
        $this->done();
    }

    private function validatePath($path)
    {
        if (!is_file(base_path($path)) && !is_dir(base_path($path))) {
            $this->red("O diretório '$path' é inválido");
            //$this->call('up');
            //die();
        }
    }

    private function createBackupPath($path)
    {
        if (!is_dir(storage_path("gitupdate/$path")) && !is_file(base_path($path))) {
            mkdir(storage_path("gitupdate/$path"), 0775, true);
        } elseif (is_file(base_path($path)) && dirname($path) !== '.') {
            $path = dirname($path);
            if (!is_dir(storage_path("gitupdate/$path"))) {
                mkdir(storage_path("gitupdate/$path"), 0775, true);
            }
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [

        ];
    }

    /**
     * @return array
     */
    private function paths()
    {
        $p = $this->process('git diff master --name-only');
        $paths = array_filter(explode("\n", $p->getOutput()), 'strlen');

        $additional = [
            '.env',
        ];

        return array_merge($paths, $additional);
    }
}
