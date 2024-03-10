<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Cidadao;
use App\Repository\CidadaoRepository;


class CidadaoControllerTest extends WebTestCase
{

    public function testCadastro()
    {
        $client = static::createClient();

        // Faz uma requisição POST para cadastrar um cidadão diretamente
        $client->request('POST', '/cadastrar', ['nome' => 'Carlos Alberto']);

        // Verifica se a resposta após o cadastro é bem-sucedida
        $this->assertResponseIsSuccessful();

        // Obter o contêiner de serviços
        $container = $client->getContainer();
        
        $entityManager = $container->get('doctrine')->getManager();
        $cidadaoRepository = $entityManager->getRepository(Cidadao::class);
        $cidadao = $cidadaoRepository->findOneBy(['nome' => 'Carlos Alberto']);

        // Verifica se o cidadão foi encontrado no banco de dados
        $this->assertNotNull($cidadao, 'Cidadão não foi salvo corretamente');

        return $cidadao->getNis();
    }
  
    public function testPesquisarCidadaoNaoEncontrado()
    {
        $client = static::createClient();
        // Obter o contêiner de serviços
        $container = $client->getContainer();

        // Realiza a pesquisa de um NIS que não existe no banco de dados
        $client->request('GET', '/pesquisar/12345678901');

        // Obtém o Entity Manager para acessar o banco de dados
        $entityManager = $container->get('doctrine')->getManager();
        $cidadaoRepository = $entityManager->getRepository(Cidadao::class);

        // Realiza a busca pelo NIS na base de dados
        $cidadao = $cidadaoRepository->findOneBy(['nis' => '12345678901']);

        // Verifica se nenhum cidadão foi encontrado
        $this->assertNull($cidadao, 'Cidadão não foi encontrado na base de dados');
    }
}
