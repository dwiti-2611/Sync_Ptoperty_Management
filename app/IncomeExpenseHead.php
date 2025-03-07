<?php

namespace App;

use App\Transaction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomeExpenseHead extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'unit',
        'income_expense_type_id',
        'income_expense_group_id',
        'type',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
    public function IncomeExpenseType()
    {
        return $this->belongsTo('App\IncomeExpenseType', 'income_expense_type_id');
    }
    public function IncomeExpenseGroup()
    {
        return $this->belongsTo('App\IncomeExpenseGroup', 'income_expense_group_id');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'income_expense_head_id');
    }
}
