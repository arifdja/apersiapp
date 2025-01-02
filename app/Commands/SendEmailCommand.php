<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\NotifikasiModel;


class SendEmailCommand extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Email';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'send:email';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Send email to user';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'send:email [arguments] [options]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        helper('arif_helper');
        $notifikasi = new NotifikasiModel();        
        $emaildata = $notifikasi->select('trx_notifikasi.id,trx_notifikasi.uuid,trx_notifikasi.label,trx_notifikasi.isi,trx_notifikasi.url,users.email')
                                ->join('users','users.uuid = trx_notifikasi.uuid')
                                ->where('trx_notifikasi.email',0)
                                ->findAll();
        


        foreach ($emaildata as $key => $value) {
            $isi = $value['isi']." <br> <a href='".base_url()."'>SIBERIMBANG</a>";
            $email = sendMail($value['email'],$value['label'],$isi);
            if($email){
                $notifikasi->where('id',$value['id'])->set(['email' => 1])->update();
                CLI::write('Email sent successfully!', 'green');
            } else {
                CLI::error('Failed to send email.');
            }
        }
    }
}
