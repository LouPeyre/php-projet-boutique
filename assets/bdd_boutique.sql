CREATE DATABASE boutique;

USE boutique;

CREATE TABLE produit (
    id_produit int(5) NOT NULL AUTO_INCREMENT,
    reference int(15) NOT NULL,
    categorie varchar(70) NOT NULL,
    titre varchar(150) NOT NULL,
    description text NOT NULL,
    couleur varchar(10) NOT NULL,
    taille varchar(2) NOT NULL,
    sexe enum('m','f') NOT NULL,
    photo varchar(250) NOT NULL,
    prix double(7,2) NOT NULL,
    stock int(4) NOT NULL,
    PRIMARY KEY (id_produit),
    UNIQUE KEY reference (reference)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;


INSERT INTO produit (id_produit, reference, categorie, titre, description, couleur, taille, sexe, photo, prix, stock) VALUES
(1, 529, 'botte', 'botte beige', ' Informations additionnelles sur la tige: fermeture éclair latérale\r\nSemelle intérieure: Textile\r\nDoublure: Textile\r\nForme du talon: Talon large\r\nHauteur du talon: 7 cm\r\nHauteur de la tige: 36 cm\r\nLargeur de la tige: 36 cm\r\nInformations additionnelles: cuir plissé, boucle\r\nSystème de fixation: Boucle\r\nBout de la chaussure: Rond\r\nSemelle: Synthétique de haute qualité\r\nDessus / Tige: Cuir\r\nRéférence: ZI111C08Y-708', 'beige', 'S', 'm', 'http://localhost/PHP/boutique/photo/bottebeigef.jpg', 60.00, 0),
(2, 530, 'botte', 'botte noir', ' Informations additionnelles sur la tige: fermeture éclair latérale\r\nSemelle intérieure: Cuir\r\nDoublure: Textile\r\nHauteur du talon: 5 cm\r\nHauteur de la tige: 38 cm\r\nLargeur de la tige: 36 cm\r\nInformations additionnelles: ganse élastique\r\nSystème de fixation: Sans lacets\r\nBout de la chaussure: Rond\r\nSemelle: Synthétique de haute qualité\r\nDessus / Tige: Cuir\r\nRéférence: ZI111C09A-802', 'noir', 'S', 'f', 'http://localhost/PHP/boutique/photo/bottenoirf.jpg', 70.00, 424),
(3, 531, 'chemise', 'superbe chemise', 'Cette chemise masculine à coupe NON CINTRÉE blanche à rayure de notre série Corporate est ravissante. Remarquez sa doublure blanche , ses poignets mousquetaires ainsi que son galon de col et ses boutonnières grises, autant de particularités qui en font un modèle essentiel à votre garde-robe. ', 'blanc', 'S', 'm', 'http://localhost/PHP/boutique/photo/chemiseblanchem.jpg', 35.00, 289),
(4, 532, 'chemise', 'belle chemise', 'La chemise en popeline 100 % coton. Incontournable dans le dressing masculin. Coupe slim (ajustée). Col pointes libres. Empiècement dos. Chemise manches longues, poignets boutonnés. Base liquette. Long. 76 cm. Encolures (en cm). ', 'noir', 'S', 'm', 'http://localhost/PHP/boutique/photo/chemisenoirm.jpg', 70.00, 179),
(5, 533, 'pull', 'pull pour toutes occasion', 'Superbe pull. \r\nDescription :\r\n55% coton, 45% acrylique.\r\nA essayer absolument !', 'gris', 'S', 'm', 'http://localhost/PHP/boutique/photo/pullgrism.jpg', 75.00, 102),
(6, 534, 'tshirt', 'tshirt colv', 'Tee shirt léger de coupe relativement ample.150 g/m² (blanc: 145 g/m²), 100% coton à fil de chaîne continu, maille fine, bande de propreté. Tee-shirt, Léger, manche courte, Homme, Col rond.\r\n', 'bleu', 'S', 'm', 'http://localhost/PHP/boutique/photo/tshirtbleum.jpg', 15.00, 7),
(7, 535, 'tshirt', 'tshirt fashion', '145 g/m², 100 % coton jersey ringspun (Ash: 99 % coton, 1 % viscose; Sport Grey: 85 %coton, 15 % viscose), pré-rétréci, encolure double épaisseur finition bord côtelé 1x1, élasthane, bande de propreté, coupe ample, structure tubulaire. taille : S à 3XL B&C, Col rond, Homme, Léger, manche courte, Tee-shirt.', 'vert', 'S', 'm', 'http://localhost/PHP/boutique/photo/tshirtvertm.jpg', 19.00, 94),
(8, 536, 'tshirt', 'tshirt', 'Teeshirt léger fashion, 150 g/m², 100% coton jersey ringspun avec fil "SLUB YARN". Couleurs effet usé. Col rond en cote 1X1. Bande de propreté. Coutures latérales. Couture cicatrice sur lourlet. Col rond, manche courte, Tee-shirt, Homme, Léger, Vintage', 'violet', 'S', 'm', 'http://localhost/PHP/boutique/photo/tshirtvioletm.jpg', 19.00, 1110);


CREATE TABLE commande (
    id_commande int(6) NOT NULL auto_increment,
    id_membre int(5) default NULL,
    montant double(7,2) NOT NULL,
    date datetime NOT NULL,
    etat enum('en cours de traitement','envoyé','livré') NOT NULL default 'en cours de traitement',
    PRIMARY KEY  (id_commande),
    KEY id_membre (id_membre)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;


CREATE TABLE details_commande (
    id_details_commande int(5) NOT NULL auto_increment,
    id_commande int(6) NOT NULL,
    id_produit int(5) default NULL,
    quantite int(4) NOT NULL,
    prix double(7,2) NOT NULL,
    PRIMARY KEY  (id_details_commande),
    KEY id_produit (id_produit)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;


CREATE TABLE membre (
    id_membre int(5) NOT NULL auto_increment,
    pseudo varchar(15) NOT NULL,
    mdp varchar(250) NOT NULL,
    nom varchar(20) NOT NULL,
    prenom varchar(20) NOT NULL,
    email varchar(50) NOT NULL,
    sexe enum('m','f') NOT NULL,
    ville varchar(20) NOT NULL,
    cp int(5) unsigned zerofill NOT NULL,
    adresse text NOT NULL,
    statut int(1) NOT NULL DEFAULT 0,
    PRIMARY KEY  (id_membre),
    UNIQUE KEY pseudo (pseudo)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;


INSERT INTO membre (id_membre, pseudo, mdp, nom, prenom, email, sexe, ville, cp, adresse, statut) VALUES
(1, 'test', 'test', 'test', 'test', 'test@site.fr', 'm', 'test', '92', 'test', 0),
(2, 'admin', 'admin', 'admin', 'admin', 'admin@site.fr', 'm', 'admin', '75', 'admin', 1);


ALTER TABLE commande
    ADD CONSTRAINT commande_ibfk_1 FOREIGN KEY (id_membre) REFERENCES membre (id_membre) ON DELETE SET NULL ON UPDATE CASCADE;


ALTER TABLE details_commande
    ADD CONSTRAINT details_commande_ibfk_1 FOREIGN KEY (id_produit) REFERENCES produit (id_produit) ON DELETE SET NULL ON UPDATE CASCADE;
