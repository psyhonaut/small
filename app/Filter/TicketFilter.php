<?php

namespace App\Filter;

use Illuminate\Support\Facades\Auth;

class TicketFilter
{
  protected $builder;
  protected $request;

  public function __construct($builder, $request)
  {
    $this->builder = $builder;
    $this->request = $request;
  }

  public function apply()
  {
    foreach ($this->filters() as $filter => $value)
    {
      if (method_exists($this, $filter))
      {
        $this->$filter($value);
      }
    }

    if (!Auth::user()->isModerator())
    {
      $userID = Auth::id();
      $this->builder->where('user_id', $userID);
    }

    if (!$this->request->has('active'))
    {
      $this->builder->where('active', 1);
    }

    return $this->builder;
  }

  public function department($value)
  {
    if (!$value) return;
    $this->builder->where('department_id', $value);
  }

  public function filters()
  {
    return $this->request->all();
  }
}
