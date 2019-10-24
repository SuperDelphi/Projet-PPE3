<?php

class Model
{

    static $connections = array();
    public $conf = 'default';
    public $table = false;
    public $db;

    function __construct()
    {
        // Connexion à la base de données
        $conf = Conf::$databases[$this->conf];
        if (isset(Model::$connections[$this->conf])) {
            $this->db = Model::$connections[$this->conf];
        }

        try {
            $pdo = new PDO('mysql:host=' . $conf['host'] . ';dbname=' . $conf['database'] . ';', $conf['login'], $conf['password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            Model::$connections[$this->conf] = $pdo;
            $this->db = Model::$connections[$this->conf];
        } catch (PDOException $e) {
            if (Conf::$debug >= 1) {
                die($e->getMessage());
            } else {
                die('Connexion à la base de données impossible.');
            }
        }

        // Initialisation des variables
        if ($this->table === false) {
            $this->table = strtolower(get_class($this)) . 's';
        }
    }

    function findFirst($req, $ret = 'OBJ')
    {
        return current($this->find($req, $ret));
    }

    function find($req = '', $ret = 'OBJ')
    {
        // Si $ret != "OBJ", alors on renvoie dun tableau associatif
        if ($ret == 'OBJ') {
            $par_ret = PDO::FETCH_OBJ;
        } else {
            $par_ret = PDO::FETCH_BOTH;
        }
        $sql = 'select ';

        // Si la projection est renseignée, on l'utilise. Dans le cas contraire, on met toutes les colonnes (*)
        if (isset($req['projection'])) {
            $sql .= $req['projection'] . ' ';
        } else {
            $sql .= '* ';
        }
        $sql .= ' from ' . $this->table . ' ';

        // On construit la condition
        if (isset($req['conditions'])) {
            $sql .= 'where ';
            if (!is_array($req['conditions'])) {
                $sql .= $req['conditions'];
            } else {
                $cond = array();
                foreach ($req['conditions'] as $k => $v) {
                    if (!is_numeric($v)) {
                        $v = $this->db->quote($v);
                    }
                    $cond[] = "$k = $v ";
                }
                $sql .= implode(' AND ', $cond);
            }
            $sql .= ' ';
        }

        // Si le GROUP BY est renseigné, alors on l'ajoute à la requête
        if (isset($req['groupby'])) {
            $sql .= 'group by ';

            $sql .= $req['groupby'];
        }

        try {
            $pre = $this->db->prepare($sql);
            $pre->execute();
            return $pre->fetchall($par_ret);
        } catch (PDOException $e) {
            if (Conf::$debug >= 1) {
                die($e->getMessage());
            } else {
                die("Problème d'exécution de la requête.");
            }
        }
    }

    function delete($req)
    {
        $sql = 'DELETE FROM ' . $this->table . ' ';

        // On construit la condition
        if (isset($req['conditions'])) {
            $sql .= 'where ';
            if (!is_array($req['conditions'])) {
                $sql .= $req['conditions'];
            } else {
                $cond = array();
                foreach ($req['conditions'] as $k => $v) {
                    if (!is_numeric($v)) {
                        $v = $this->db->quote($v);
                    }
                    $cond[] = "$k = $v ";
                }
                $sql .= implode(' AND ', $cond);
            }
        }
        $info = null;
        try {
            $pre = $this->db->prepare($sql);
            $pre->execute();
        } catch (PDOException $e) {
            $info = $e->getMessage();
        }
        return $info;
    }

    function update($req)
    {
        $info = null;
        $sql = 'update ' . $this->table . ' set ';
        // On récupère les données à mettre à jour dans $req['donnees'] ainsi que la clé primaire dans $req['cle']
        // On met des quotes aux chaînes de caractères
        $cond = array();
        foreach ($req['donnees'] as $k => $v) {
            if (!is_numeric($v)) {
                $v = $this->db->quote($v);
            }
            $cond[] = "$k = $v ";
        }
        $sql .= implode(',', $cond);
        $sql .= ' where ';
        $cle = array();
        $conditions = array();

        // Permet d'être compatible avec une version où l'on attendait une clé au lieu de conditions
        if (isset($req['cle'])) {
            $conditions = $req['cle'];
        }
        if (isset($req['conditions'])) {
            $conditions = $req['conditions'];
        }
        foreach ($conditions as $k => $v) {
            if (!is_numeric($v)) {
                $v = $this->db->quote($v);
            }
            $cle[] = "$k = $v ";
        }

        $sql .= implode('AND', $cle);

        try {
            $pre = $this->db->prepare($sql);
            $pre->execute();
        } catch (PDOException $e) {
            $info = $e->getMessage();
        }
        return $info;
    }

    /**
     * Insertion d'une ligne avec une colonne en AUTO_INCREMENT
     */
    function insertAI($colonnes, $donnees)
    {
        $sql = 'insert into ' . $this->table . ' ( ';
        $sql .= implode(',', $colonnes);
        $sql .= ') values(';
        //on récupère les données à mettre à jour dans $req['donnees'] et la clef primaire dans $req['cle']
        //on met des quotes aux chaines de caractères
        $cond = array();
        foreach ($donnees as $v) {
            if (!is_numeric($v)) {
                $v = $this->db->quote($v);
            }
            $cond[] = $v;
        }
        $sql .= implode(',', $cond);

        $sql .= ');';


        $pre = $this->db->prepare($sql);
        $pre->execute();
        $tab = $this->db->query('SELECT LAST_INSERT_ID() AS last_id');
        $tab1 = $tab->fetchALL(PDO::FETCH_ASSOC);
        $last_id = $tab1[0]['last_id'];
        return $last_id;
    }

    /**
     * Insertion d'une ligne
     */
    function insert($colonnes, $donnees)
    {
        $info = null;
        $sql = 'insert into ' . $this->table . ' ( ';
        $sql .= implode(',', $colonnes);
        $sql .= ') values(';

        // On récupère les données à mettre à jour dans $req['donnees'] ainsi que la clé primaire dans $req['cle']
        // On met des guillemets aux chaines de caractères
        $cond = array();
        foreach ($donnees as $v) {
            if (!is_numeric($v)) {
                $v = $this->db->quote($v);
            }
            $cond[] = $v;
        }
        $sql .= implode(',', $cond);

        $sql .= ');';
        try {
            $pre = $this->db->prepare($sql);
            $pre->execute();
        } catch (PDOException $e) {
            $info = $e->getMessage();
        }
        return $info;
    }

}