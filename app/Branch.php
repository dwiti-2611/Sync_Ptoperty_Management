<?php

namespace App;

use App\Sell;
use App\Product;
use App\Transaction;
use App\PurchaseOrder;
use App\PurchaseRequisition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'location',
        'description',
        'create_by',
        'update_by',
        'delete_by'
    ];

    /**
     * This function return has many relation
     *
     * @author      Md. Al-Mahmud <mamun120520@gmail.com>
     * @version     1.0
     * @see         
     * @since       11/12/2022
     * Time         07:52:02
     * @param       
     * @return      
     */
    public function products()
    {
        # code...   
        return $this->hasMany(Product::class, 'branch_id');
    }
    #end

    /**
     * This function return has many relaton on transactioin
     *
     * @author      Md. Al-Mahmud <mamun120520@gmail.com>
     * @version     1.0
     * @see         
     * @since       11/12/2022
     * Time         07:59:47
     * @param       
     * @return      
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'branch_id');
    }
    #end

    /**
     * This function return has many relaton on sells
     *
     * @author      Md. Al-Mahmud <mamun120520@gmail.com>
     * @version     1.0
     * @see         
     * @since       11/12/2022
     * Time         07:59:47
     * @param       
     * @return      
     */
    public function sells()
    {
        return $this->hasMany(Sell::class, 'branch_id');
    }
    #end

    /**
     * This function has many relaton on Requisition
     *
     * @author      Md. Al-Mahmud <mamun120520@gmail.com>
     * @version     1.0
     * @see         
     * @since       11/12/2022
     * Time         09:46:26
     * @param       
     * @return      
     */
    public function purchase_requisitions()
    {
        # code...   
        return $this->hasMany(PurchaseRequisition::class, 'branch_id');
    }
    #end

    /**
     * This function has many relaton on Requisition
     *
     * @author      Md. Al-Mahmud <mamun120520@gmail.com>
     * @version     1.0
     * @see         
     * @since       11/12/2022
     * Time         09:46:26
     * @param       
     * @return      
     */
    public function purchase_orders()
    {
        # code...   
        return $this->hasMany(PurchaseOrder::class, 'branch_id');
    }
    #end


}
