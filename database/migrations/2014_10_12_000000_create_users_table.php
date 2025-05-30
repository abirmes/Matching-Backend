
    <?php

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
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('firstname');
                $table->string('lastname');
                $table->date('date_naissance');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->unsignedBigInteger('role_id');
                $table->unsignedBigInteger('adresse_id');
                $table->foreign('role_id')->references('id')->on('roles');
                $table->foreign('adresse_id')->references('id')->on('adresses');
                $table->rememberToken();
                $table->timestamps();
                $table->engine = 'InnoDB';
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('users');
        }
    };
