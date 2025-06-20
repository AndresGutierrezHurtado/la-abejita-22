<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\SchoolRepository;

class TestSchoolRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:school-repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the school repository methods';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $schoolRepository = new SchoolRepository();

        $schools = $schoolRepository->getAll();

        $this->info('Total schools: ' . count($schools));

        $school = $schoolRepository->getById('c04e94b6-be87-4951-860d-82de26ddf21c');

        $this->info('School obtained by id: ' . json_encode($school));

        $createdSchool = $schoolRepository->create([
            'school_name' => 'Test',
            'school_nit' => '1234567890',
            'school_address' => 'Test',
            'school_image' => 'Test',
        ]);

        $this->info('School created: ' . json_encode($createdSchool));

        $school = $schoolRepository->update($createdSchool['school_id'], [
            'school_name' => 'Prueba',
            'school_nit' => '1234567890',
        ]);

        $this->info('School updated: ' . json_encode($school));

        $school = $schoolRepository->delete($createdSchool['school_id']);

        $this->info('School deleted: ' . json_encode($school));
    }
}
