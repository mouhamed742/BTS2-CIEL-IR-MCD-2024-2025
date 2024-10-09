1- les caractéristique du champion.
2
- le nom du champion.
- la clé primaire.
- varchar.
3- Genre, Rôle, Espèce, Ressource, Type de portée, Région(s), Année de sortie.
4- Genre, Rôle,Espèce, Type de portée, Région(s), Année de sortie.
5- -Un champion a un genre et un genre appartient à plusieurs champions.
  - Un champion a un rôle et un rôle appartient à plusieurs champions.
  - Un champion a une ou plusieurs Espèce et une ou plusieurs Espèce ont plusieurs champions.
  - Un champion a une ressource et une ressource appartient à plusieurs champions.
  - Un champion a un ou plusieurs Type de portée et un ou plusieurs Type de portée ont plusieurs champions.
  - Un champion a un ou plusieurs Région  et  un ou plusieurs Région ont plusieurs champions.
  - Un champion a une année de sortie et une année de sortie à plusieurs champions.
6-
- Oui Un Champion peut avoir plusieurs instances Rôle, Espèce, Type de portèe, Région.
- Oui elle peut-elle être par plusieurs champions.
- (1,1)->(1,n)
- (1,1)->(1,n)
- (1,n)->(1,n)
- (1,n)->(1,n)
- (1,n)->(1,n)
- (1,n)->(1,n)
- (1,1)->(1,n)
