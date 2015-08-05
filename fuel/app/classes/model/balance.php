<?php
use Orm\Model;

class Model_Balance extends Model
{
	protected static $_properties = array(
		'id',
        'user_id',
		'description',
		'debit',
		'credit',
		'balance',
		'created_at',
		'updated_at',
//        'TotalBalance',
//        'DailyBalance',
//        'PeriodBalace',
//        'CustomerBalance',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('description', 'Description', 'required');
		$val->add_field('debit', 'Debit', 'required');
		$val->add_field('credit', 'Credit', 'required');
		$val->add_field('balance', 'Balance', 'required');

		return $val;
	}

	public static function totalBalance()
	{

    /*
     *   --total balance
	 *	return $val;
    */
       $sql = "SELECT (SUM(debit)*-1) + SUM(credit) AS TotalBalance FROM balances ";
       return $total_balance = DB::query($sql)->as_object('Model_Balance')->execute();
    }

    public static function dailyBalance()
    {
        /*
         *    --daily balance
         * */
        $sql = "SELECT created_at, (SUM(debit)*-1) + SUM(credit) AS DailyBalance FROM balances GROUP BY created_at";
        return $daily_balance = DB::query($sql)->as_object('Model_Balance')->execute();


    }
// Need to fiqure this one out with UNIX TIME
    public static function periodTimeBalance()
    {
        /*
         *    --period of time balance
         * */
        $sql = "SELECT (SUM(debit)*-1) + SUM(credit) AS PeriodBalace FROM balances
                WHERE created_at BETWEEN UNIX_TIMESTAMP() AND ADDDATE(UNIX_TIMESTAMP() INTERVAL -30 DAY)";
        return $period_time_balance = DB::query($sql)->as_object('Model_Balance')->execute();

    }


    public static function customerBalance($userId)
    {
        /*
         *    --customer balance
         * */
//        DB::expr('AS CustomerBalance ');
//        $sql = "SELECT user_id, (SUM(debit)*-1) + SUM(credit)
//                AS CustomerBalance FROM balances GROUP BY user_id";
        $sql = "SELECT user_id, (SUM(debit)*-1) + SUM(credit)
                AS balance FROM balances
                WHERE user_id = " . $userId .
                " GROUP BY user_id";

//        DB::expr('COUNT(table_name.table_column)');
        return $customer_balance = DB::query($sql)->as_object('Model_Balance')->execute();

    }

}
