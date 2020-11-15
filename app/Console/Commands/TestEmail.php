<?php

namespace App\Console\Commands;

use App\Mail\TestEmailMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envie um e-mail de teste, usando a configuração de e-mail atual';

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
        $this->info('Enviando Email de Teste');

        sleep(3);

        try {
            Mail::to(env('MAIL_USERNAME'))->send(new TestEmailMail());
        } catch (\Exception $exception) {
            $this->error('Falhou');;
            $this->alert('Falha ao enviar e-mail. Por favor, revise suas configurações de e-mail no arquivo .env.');
            exit();
        }

        $this->alert('Email foi enviado com sucesso!');
    }
}
