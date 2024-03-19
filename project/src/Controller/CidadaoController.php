<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cidadao;
use App\Form\CidadaoType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CidadaoRepository;

class CidadaoController extends AbstractController
{
    private $entityManager;
    private $cidadaoRepository;

    public function __construct(EntityManagerInterface $entityManager, CidadaoRepository $cidadaoRepository)
    {
        $this->entityManager = $entityManager;
        $this->cidadaoRepository = $cidadaoRepository;
    }

    public function index(): Response
    {
        return $this->render('cadastro/index.html.twig');
    }

    /**
     * @Route("/cadastro", name="cadastro")
     */
    public function cadastrar(Request $request): Response
    {
        $cidadao = new Cidadao();
        $form = $this->createForm(CidadaoType::class, $cidadao);
        $form->handleRequest($request);

        $nomeCidadao = $request->request->get('nome');

        if (!empty($nomeCidadao)) { 

            $cidadao->setNis($this->gerarNis());
            $cidadao->setNome($nomeCidadao);
            $this->entityManager->persist($cidadao);
            $this->entityManager->flush();

            return $this->render('cadastro/sucesso.html.twig', [
                'nis' => $cidadao->getNis(),
            ]);
        
        }

        return $this->render('cadastro/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    private function gerarNis(): string
    {
        do {
            // Gera os primeiros 10 dígitos aleatórios
            $nis = mt_rand(1000000000, 9999999999);

            // Calcula o dígito verificador
            $soma = 0;
            $peso = 3;

            foreach (str_split((string) $nis) as $digito) {
                $soma += $digito * $peso;
                $peso = ($peso == 3) ? 2 : 3;
            }

            $resto = $soma % 11;
            $digitoVerificador = 11 - $resto;

            // Verifica se o dígito verificador está no intervalo de 0 a 9
            if ($digitoVerificador >= 10) {
                $digitoVerificador = 0;
            }

            // Concatena o dígito verificador ao NIS
            $nis .= $digitoVerificador;
        } while (strlen($nis) != 11);

        return $nis;
    }

    /**
     * @Route("/pesquisar", name="pesquisar")
     */
    public function pesquisar(Request $request): Response
    {
        // Se não houver dados enviados, exibe o formulário de pesquisa
        return $this->render('cadastro/pesquisar.html.twig');
    }


    /**
     * @Route("/pesquisar", name="pesquisar_post", methods={"POST"})
     */
    public function pesquisarPost(Request $request): Response
    {        
        $nis = $request->get('nis');
        $cidadao = $this->cidadaoRepository->findByNis($nis);

        if ($cidadao) {
            return $this->render('cadastro/encontrado.html.twig', [
                'nome' => $cidadao->getNome(),
                'nis' => $cidadao->getNis(),
            ]);
        } else {
            return $this->render('cadastro/nao_encontrado.html.twig');
        }
    }
}
