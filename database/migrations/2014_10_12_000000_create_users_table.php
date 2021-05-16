<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('tipo_pessoa', function (Blueprint $table) {
            $table->id();
            $table->string('descricao')->unique();
        });

        Schema::create('endereco', function (Blueprint $table) {
            $table->id();
            $table->string('cep');
            $table->string('logradouro');
            $table->string('bairro');
            $table->string('numero');
            $table->string('complemento');
        });

        Schema::create('pessoa', function (Blueprint $table) {
            $table->id();
            $table->string('telefone');
            $table->bigInteger('endereco_id')->unsigned();
            $table->bigInteger('tipo_pessoa_id')->unsigned();
            $table->foreign('endereco_id')->references('id')->on('endereco');
            $table->foreign('tipo_pessoa_id')->references('id')->on('tipo_pessoa');
        });

        Schema::create('pessoa_juridica', function (Blueprint $table) {
            $table->id();
            $table->string('nome_fantasia');
            $table->string('razao_social');
            $table->string('cnpj');
            $table->bigInteger('pessoa_id')->unsigned();
            $table->foreign('pessoa_id')->references('id')->on('pessoa');
        });

        Schema::create('biblioteca', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pessoa_juridica_id')->unsigned();
            $table->foreign('pessoa_juridica_id')->references('id')->on('pessoa_juridica');
        });

        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->bigInteger('pessoa_id')->unsigned();
            $table->foreign('pessoa_id')->references('id')->on('pessoa');
        });

        Schema::create('senha', function (Blueprint $table) {
            $table->id();
            $table->string('senha');
            $table->bigInteger('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('usuario');
        });

        Schema::create('alteracao_senha', function (Blueprint $table) {
            $table->id();
            $table->timestamp('data_alteracao');
            $table->bigInteger('senha_id')->unsigned();
            $table->foreign('senha_id')->references('id')->on('senha');
        });

        Schema::create('pessoa_fisica', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pessoa_id')->unsigned();
            $table->foreign('pessoa_id')->references('id')->on('pessoa');
            $table->string('cpf');
            $table->date('data_nascimento');
            $table->string('genero');
            $table->string('nome');
            $table->longText('foto');
        });

        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pessoa_fisica_id')->unsigned();
            $table->foreign('pessoa_fisica_id')->references('id')->on('pessoa_fisica');
        });

        Schema::create('bibliotecario', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pessoa_fisica_id')->unsigned();
            $table->foreign('pessoa_fisica_id')->references('id')->on('pessoa_fisica');
        });

        Schema::create('genero', function (Blueprint $table) {
            $table->id();
            $table->string('descricao')->unique();
        });

        Schema::create('idioma', function (Blueprint $table) {
            $table->id();
            $table->string('descricao')->unique();
        });

        Schema::create('autor', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->string('descricao');
        });

        Schema::create('livro', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descricao');
            $table->bigInteger('autor_id')->unsigned();
            $table->bigInteger('genero_id')->unsigned();
            $table->bigInteger('idioma_id')->unsigned();
            $table->foreign('autor_id')->references('id')->on('autor');
            $table->foreign('genero_id')->references('id')->on('genero');
            $table->foreign('idioma_id')->references('id')->on('idioma');
        });

        Schema::create('exemplar', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('livro_id')->unsigned();
            $table->bigInteger('cadastrado_por')->unsigned();
            $table->foreign('livro_id')->references('id')->on('livro');
            $table->foreign('cadastrado_por')->references('id')->on('bibliotecario');
            $table->date('data_entrada');
        });

        Schema::create('aluguel', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('exemplar_id')->unsigned();
            $table->bigInteger('cliente_id')->unsigned();
            $table->bigInteger('bibliotecario_id')->unsigned();
            $table->foreign('exemplar_id')->references('id')->on('exemplar');
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->foreign('bibliotecario_id')->references('id')->on('bibliotecario');
            $table->date('data_devolucao');
        });

        Schema::create('devolucao', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('aluguel_id')->unsigned();
            $table->bigInteger('bibliotecario_id')->unsigned();
            $table->foreign('aluguel_id')->references('id')->on('aluguel');
            $table->foreign('bibliotecario_id')->references('id')->on('bibliotecario');
            $table->date('data_devolucao');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('tipo_pessoa');
        Schema::dropIfExists('endereco');
        Schema::dropIfExists('pessoa');
        Schema::dropIfExists('pessoa_juridica');
        Schema::dropIfExists('biblioteca');
        Schema::dropIfExists('usuario');
        Schema::dropIfExists('senha');
        Schema::dropIfExists('alteracao_senha');
        Schema::dropIfExists('pessoa_fisica');
        Schema::dropIfExists('cliente');
        Schema::dropIfExists('bibliotecario');
        Schema::dropIfExists('genero');
        Schema::dropIfExists('idioma');
        Schema::dropIfExists('autor');
        Schema::dropIfExists('livro');
        Schema::dropIfExists('exemplar');
        Schema::dropIfExists('aluguel');
        Schema::dropIfExists('devolucao');
        Schema::enableForeignKeyConstraints();
    }
}
