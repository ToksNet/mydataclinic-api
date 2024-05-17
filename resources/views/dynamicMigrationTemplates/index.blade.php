<{{ $phptag }}

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('{{ $tableName }}', function (Blueprint $table) {
            $table->ulid('id')->primary();
            @foreach ($schema as $columName => $dataType) 
            $table->{{ $dataType }}('{{ strtolower($columName)}}');
            @endforeach
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('{{ $tableName }}');
    }
};
