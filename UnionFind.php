<?php

class UnionFind
{
    private $id = [];
    private $count;

    public function __construct(int $N)
    {
        $this->count = $N;
        for ($i = 0; $i < $N; $i++) {
            $this->id[$i] = $i;
        }
    }

    public function count(): int
    {
        return $this->count;
    }

    public function connected(int $p, int $q): bool
    {
        return $this->find($p) == $this->find($q);
    }

    public function find(int $p): int
    {
        return $this->id[$p];
    }

    public function union(int $p, int $q)
    {
        $pID = $this->find($p);
        $qID = $this->find($q);
        if ($pID == $qID) return;

        for ($i = 0; $i< count($this->id); $i++)
        {
            if ($this->id[$i] == $pID) $this->id[$i] == $qID;
        }
        $this->count--;
    }

}


$n = 625;
$uf = new UnionFind($n);
//while (!)

