<{{ $phptag }}

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
{{-- use Illuminate\Database\Eloquent\SoftDeletes; --}}
use Illuminate\Database\Eloquent\Model;

class {{ $modelName }} extends Model
{
    use HasApiTokens, HasFactory, HasUlids;


    protected $table = '{{ $tableName }}';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     
    protected $fillable = [
        @foreach($schema as $columName => $dataType)
        '{{ $columName }}',
        @endforeach
    ];

   
}
