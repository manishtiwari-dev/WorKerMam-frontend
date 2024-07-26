<?php

namespace App\Jobs;

use App\Models\WorkReport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use App\Models\UniversalSearch;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ImportWorkReportJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $row;
    private $columns;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($row, $columns)
    {
        $this->row = $row;
        $this->columns = $columns;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!empty(array_keys($this->columns, 'seo_task_id')) && !empty(array_keys($this->columns, 'website_id')) && !empty(array_keys($this->columns, 'user_id')) && !empty(array_keys($this->columns, 'created_at')) && !empty(array_keys($this->columns, 'website_url')) && !empty(array_keys($this->columns, 'landing_url'))  ) {
            DB::beginTransaction();
            try {

                $work_report = new WorkReport();
                $work_report->created_at = !empty(array_keys($this->columns, 'created_at')) ? $this->row[array_keys($this->columns, 'created_at')[0]] : null;
                $work_report->website_url = $this->row[array_keys($this->columns, 'website_url')[0]];
                $work_report->landing_url = $this->row[array_keys($this->columns, 'landing_url')[0]];
                $work_report->website_id = $this->row[array_keys($this->columns, 'website_id')[0]];
                $work_report->user_id = $this->row[array_keys($this->columns, 'user_id')[0]];
                $work_report->seo_task_id = $this->row[array_keys($this->columns, 'seo_task_id')[0]];
                $work_report->save();

                // Log search
                $this->logSearchEntry($work_report->id, $work_report->created_at, 'work-report.show', 'work-report');

                if (!is_null($work_report->website_url)) {
                    $this->logSearchEntry($work_report->id, $work_report->website_url, 'work-report.show', 'work-report');
                }

                if (!is_null($work_report->landing_url)) {
                    $this->logSearchEntry($work_report->id, $work_report->landing_url, 'work-report.show', 'work-report');
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->fail($e->getMessage());
            }
        } else {
            $this->fail(__('messages.invalidData') . json_encode($this->row, true));
        }
    }

    public function logSearchEntry($searchableId, $title, $route, $type)
    {
        $search = new UniversalSearch();
        $search->searchable_id = $searchableId;
        $search->title = $title;
        $search->route_name = $route;
        $search->module_type = $type;
        $search->save();
    }

}

