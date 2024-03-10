<?php

namespace App\Repository;

use App\Entity\Cidadao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cidadao>
 *
 * @method Cidadao|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cidadao|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cidadao[]    findAll()
 * @method Cidadao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CidadaoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cidadao::class);
    }

    // Método para buscar um cidadão pelo NIS
    public function findByNis(string $nis): ?Cidadao
    {
        return $this->findOneBy(['nis' => $nis]);
    }

    // Método para cadastrar um novo cidadão
    public function cadastrarCidadao(string $nome, string $nis): Cidadao
    {
        $entityManager = $this->getEntityManager();

        $cidadao = new Cidadao();
        $cidadao->setNome($nome);
        $cidadao->setNis($nis);

        $entityManager->persist($cidadao);
        $entityManager->flush();

        return $cidadao;
    }
}
