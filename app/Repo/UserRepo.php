<?php

namespace App\Repo;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final readonly class UserRepo
{
    private Model $model;

    /**
     * @param  private
     */
    function __construct(private User $user)
    {
        $this->model = $user;
    }

    /**
     * @return array
     */
    function get() : array
    {
        try {
            $data = $this->model::with("roles")->orderBy("updated_at", "desc")
                ->get(['id', 'name', 'email', 'mobile', 'status', 'created_at'])
                ->toArray();
            return !empty($data) ? $data : [];
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * @param string $column
     * @param string $value
     *
     * @return Model|null
     */
    function getByColumn(string $column = "id", string $value) : Model|null
    {
        try {
            $data = $this->model::where($column, $value)->first();
            return $data ?? null;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * @param array $request
     *
     * @return Model
     */
    function create(array $request) : Model
    {
        try {
            return $this->model::create($request);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * @param string $column
     * @param mixed $value
     * @param array $request
     *
     * @return bool
     */
    function update(string $column = "id", $value, array $request) : bool
    {
        try {
            return $this->model::where($column, $value)->update($request);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * @param string $column
     * @param mixed $value
     *
     * @return bool
     */
    function delete(string $column = "id", $value) : bool
    {
        try {
            return $this->model::where($column, $value)->delete();
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    function getUserRatio()
    {
        try {
            $lastDayOfMonth = Carbon::now()->startOfMonth();
            $userPercentageChange = DB::table($this->model->getTable())
            ->selectRaw("
                    COUNT(*) as total_user,
                    COUNT(CASE WHEN DATE(created_at) >= ? THEN 1 ELSE null END) as current_month_user,
                    COUNT(CASE WHEN DATE(created_at) < ? THEN 1 ELSE null END) as previous_month_user,
                    CASE
                        WHEN COUNT(CASE WHEN DATE(created_at) < ? THEN 1 ELSE null END) > 0
                        THEN ((COUNT(CASE WHEN DATE(created_at) >= ? THEN 1 ELSE null END) - COUNT(CASE WHEN DATE(created_at) < ? THEN 1 ELSE null END)) / COUNT(CASE WHEN DATE(created_at) < ? THEN 1 ELSE null END)) * 100
                        ELSE 0
                    END as percentage_user_ratio", [
                    $lastDayOfMonth, $lastDayOfMonth, // For SUM today and yesterday sales
                    $lastDayOfMonth, $lastDayOfMonth, // For COUNT today and yesterday orders
                    $lastDayOfMonth, $lastDayOfMonth// For percentage_change_orders
                ])
                ->first();
            return $userPercentageChange;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
