<?php


namespace App\Services;

use App\Enums\RegisterStatus;
use App\Models\Client;
use App\Models\Company;
use App\Models\Responsible;
use Illuminate\Support\Facades\DB;

abstract class AbstractService
{



  public function startTranscation()
  {
    DB::beginTransaction();
  }

  public function commitTranscation()
  {
    DB::commit();
  }

  public function rollbackTranscation()
  {
    DB::rollBack();
  }
}
