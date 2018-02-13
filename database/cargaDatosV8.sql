-- Insert Datos;
-- Deportes
insert into deportes values (null,'Natación','Ejercitar el cuerpo en una piscina en diferentes estilos','','','','natacion1.jpg','#546de5'),
							(null,'Tenis','consiste en impulsar una pelota con una raqueta por encima de la red intentando que bote en el campo contrariodeporte_centro','','','','tenis1.jpg','#f5cd79'),
                            (null,'Pádel','Tenis en una jaula de cristal, en la que la bola no puede salir del campo','','','','padel1.jpg','#218c74'),
                            (null,'Yoga','técnicas de concentración se practican para conseguir un mayor control físico y mental','','','','yoga1.jpg','#786fa6'),
                            (null,'Atletismo','Conjunto de prácticas deportivas que comprende las pruebas de velocidad, saltos y lanzamientos','','','','atletismo1.jpg','#cf6a87'),
                            (null,'Baloncesto','Deporte en el cual compiten dos equipos de cinco jugadores cada uno. El objetivo es introducir la pelota en el aro','','','','baloncesto1.jpg','#f19066'),
                            (null,'Crossfit','Sistema de entrenamiento de fuerza y acondicionamiento basado en ejercicios funcionales variados de alta intensidad','','','','crossfit1.jpg','#0c2461');

-- Centros

insert into centros values (null,'Pabellon de Mislata','963258741','PabellonMislata@gmail.com','Camino Molino del Sol','Mislata','Valencia','España','39.478758','-0.414405','../resources/img/centros/pabellon_mislata.jpg',null),
							(null,'Gimnasio Olimpia','963958741','GimnasioOlimpia@gmail.com','Mare de Déu dels Desemparats, 46','Mislata','Valencia','España','39.478101','-0.416468','../resources/img/centros/olimpia.jpg',null),
                            (null,'Polideportivo Sedavi','963987456','PolideportivoSedavi@gmail.com','Carrer Fernando Baixauli Chornet','Sedaví','Valencia','España','39.422985',' -0.379039','../resources/img/centros/poli_sedavi.jpg',null),
                            (null,'Personal Gym','963325416','PersonalGym@gmail.com','Carrer de Cerdà de Tallada, 2','Valencia','Valencia','España','39.471478','-0.369942','../resources/img/centros/personal_gym.jpg',null),
                            (null,'Club Shidokan','963854123','ClubShidokan@gmail.com','Av. de Blasco Ibáñez, 90','Valencia','Valencia','España','39.474353','-0.350746','../resources/img/centros/shidokan.jpg',null),
                            (null,'Cross Fitnes Elit SL','963785436','CrossFitnesElit@gmail.com','Carrer de Joan Verdeguer, 2','Valencia','Valencia','España','39.458956','-0.340112','../resources/img/centros/cross_fitnes_elit.jpg',null),
                           (null,'Polideportivo Municipal Quart De Poblet','963985765','DeportivoQuart@gmail.com','Av. Antic Regne València, 102','Quart de Poblet','Valencia','España','39.481455',' -0.434220','../resources/img/centros/polideportivo_quart_de_poblet.jpg',null),
                           (null,'Cross Fitnes Alicante','964785693','CrossFitnesAli@gmail.com','Calle Concha Espina,14','Alicante','Alicante','España','38.336405','-0.508820','../resources/img/centros/crossfit_alicante.jpg',null),
                           (null,'Polideportivo Elche','964159687','PoliElche@gmail.com','Carrer Victoria Kent,102','Alicante','Alicante','España','38.278333','-0.708188','../resources/img/centros/polideportivo_elche.jpg',null),
                           (null,'Gimnasio Sport-go','964751489','GimnasioSportGo@gmail.com','Plaza America,9','Alicante','Alicante','España','38.383043','-0.507954','../resources/img/centros/gimnasio_sport_go.jpg',null),
                           (null,'Centro deportivo Walago','964565986','Walago@gmail.com','Av.Locutor Vicente Hipolito,46','Alicante','Alicante','España','38.374990','-0.424937','../resources/img/centros/walago.jpg',null),
                           (null,'Polideportivo Onda','966541238','PolideportivoOnda@gmail.com','Carrer Isodoro Peris,15','Onda','Castellon','España','39.967492',' -0.261149','../resources/img/centros/polideportivo_onda.jpg',null),
                           (null,'Centro deportivo Castellon','966987451','DeportCastellon@gmail.com','Carrer dels columbrets,87','Castellon','Castellon','España','39.987015','-0.027146','../resources/img/centros/centro_deportivo_castellon.jpg',null),
                           (null,'Deportivo Burriana','966985235','PoliBurriana@gmail.com','Cami de Artana,36','Burriana','Castellon','España','39.889709','-0.092819','../resources/img/centros/deportivo_burriana.jpg',null),
                           (null,'Gimansio Only fitness','966475847','OnlyFitGym@gmail.com','Carrer Calderon de la barca,45','Castellon','Castellon','España','39.973094','-0.057845','../resources/img/centros/gimnasio_only_fitnes.jpg',null);
 
 -- usuarios 
 
insert into usuarios values (null,'53250944X','Raimundo','García','Vasco',current_date(),'Ray','1111','Raigarva@gmail.com','gerente',(select id_centro from centros where nombre = 'Pabellon de Mislata'),null,current_date()),
							(null,'26874556D','Daniel','Alba','Diaz',current_date(),'Dani','2222','Danialba96@gmail.com','gerente',null,null,current_date()),
                            (null,'28332211M','Asun','Sanz',' ',current_date(),'Asun','3333','Asun.Sanz@gmail.com','gerente',null,null,current_date()),
                             (null,'28332211F','John','Doe',' Doe',current_date(),'deportista','1111','deportista@gmail.com','deportista',null,null,current_date()),
                            (null,'56893214F','Adolfo','Garcia','Escobar',current_date(),'Adolfo','4444','adolfogarciaescobar@gmail.com','gerente',null,null,current_date());
                            
 -- deporte_centro
 
                     
insert into pistas_deporte_centro values ((select id_deporte from deportes where nombre = 'Natación'),(select id_centro from centros where nombre = 'Cross Fitnes Alicante'),1,7.5,'10:00','20:00',10,45,null),
											((select id_deporte from deportes where nombre = 'Natación'),(select id_centro from centros where nombre = 'Pabellon de Mislata'),1,7.5,'10:00','20:00',10,39,null),
                                            ((select id_deporte from deportes where nombre = 'Natación'),(select id_centro from centros where nombre = 'Polideportivo Elche'),1,7.5,'10:00','20:00',10,42,null),
                                            ((select id_deporte from deportes where nombre = 'Natación'),(select id_centro from centros where nombre = 'Gimnasio Sport-go'),1,7.5,'10:00','20:00',10,45,null),
                                            ((select id_deporte from deportes where nombre = 'Natación'),(select id_centro from centros where nombre = 'Club Shidokan'),1,7.5,'10:00','20:00',10,32,null),
                                            ((select id_deporte from deportes where nombre = 'Natación'),(select id_centro from centros where nombre = 'Polideportivo Sedavi'),1,7.5,'10:00','20:00',10,42,null),
                                            ((select id_deporte from deportes where nombre = 'Natación'),(select id_centro from centros where nombre = 'Polideportivo Onda'),1,7.5,'10:00','19:00',10,32,null),
											((select id_deporte from deportes where nombre = 'Pádel'),(select id_centro from centros where nombre = 'Polideportivo Elche'),1,7.5,'10:00','22:00',10,39,null),
											((select id_deporte from deportes where nombre = 'Pádel'),(select id_centro from centros where nombre = 'Polideportivo Municipal Quart De Poblet'),1,7.5,'10:00','22:00',10,45,null),
                                            ((select id_deporte from deportes where nombre = 'Pádel'),(select id_centro from centros where nombre = 'Polideportivo Onda'),1,7.5,'10:00','22:00',10,42,null),
                                            ((select id_deporte from deportes where nombre = 'Pádel'),(select id_centro from centros where nombre = 'Centro deportivo Castellon'),1,7.5,'10:00','22:00',10,39,null),
                                            ((select id_deporte from deportes where nombre = 'Pádel'),(select id_centro from centros where nombre = 'Deportivo Burriana'),1,7.5,'10:00','22:00',10,32,null),
                                            ((select id_deporte from deportes where nombre = 'Pádel'),(select id_centro from centros where nombre = 'Club Shidokan'),1,7.5,'10:00','22:00',10,37,null),
                                            ((select id_deporte from deportes where nombre = 'Pádel'),(select id_centro from centros where nombre = 'Pabellon de Mislata'),1,7.5,'10:00','22:00',10,49,null),
                                            ((select id_deporte from deportes where nombre = 'Pádel'),(select id_centro from centros where nombre = 'Pabellon de Mislata'),2,7.5,'10:00','22:00',10,45,null),
                                            ((select id_deporte from deportes where nombre = 'Pádel'),(select id_centro from centros where nombre = 'Polideportivo Sedavi'),1,7.5,'10:00','22:00',10,42,null),
                                            ((select id_deporte from deportes where nombre = 'Pádel'),(select id_centro from centros where nombre = 'Polideportivo Sedavi'),2,7.5,'10:00','22:00',10,39,null),
											((select id_deporte from deportes where nombre = 'Atletismo'),(select id_centro from centros where nombre = 'Gimnasio Sport-go'),1,7.5,'10:00','22:00',10,32,null),
											((select id_deporte from deportes where nombre = 'Atletismo'),(select id_centro from centros where nombre = 'Centro deportivo Castellon'),1,7.5,'10:00','18:00',10,39,null),
                                            ((select id_deporte from deportes where nombre = 'Atletismo'),(select id_centro from centros where nombre = 'Centro deportivo Castellon'),2,7.5,'10:00','18:00',10,45,null),
                                            ((select id_deporte from deportes where nombre = 'Atletismo'),(select id_centro from centros where nombre = 'Pabellon de Mislata'),1,7.5,'10:00','21:00',10,49,null),
                                            ((select id_deporte from deportes where nombre = 'Atletismo'),(select id_centro from centros where nombre = 'Pabellon de Mislata'),2,7.5,'10:00','21:00',10,42,null),
                                            ((select id_deporte from deportes where nombre = 'Atletismo'),(select id_centro from centros where nombre = 'Cross Fitnes Elit SL'),1,7.5,'10:00','20:00',10,45,null),
                                            ((select id_deporte from deportes where nombre = 'Atletismo'),(select id_centro from centros where nombre = 'Club Shidokan'),1,7.5,'10:00','22:00',10,32,null),
                                            ((select id_deporte from deportes where nombre = 'Atletismo'),(select id_centro from centros where nombre = 'Cross Fitnes Alicante'),1,7.5,'10:00','22:00',10,39,null),
                                            ((select id_deporte from deportes where nombre = 'Atletismo'),(select id_centro from centros where nombre = 'Polideportivo Municipal Quart De Poblet'),1,7.5,'10:00','20:00',10,42,null),
											((select id_deporte from deportes where nombre = 'Baloncesto'),(select id_centro from centros where nombre = 'Deportivo Burriana'),1,7.5,'10:00','19:00',10,49,null),
											((select id_deporte from deportes where nombre = 'Baloncesto'),(select id_centro from centros where nombre = 'Club Shidokan'),1,7.5,'10:00','19:00',10,45,null),
                                            ((select id_deporte from deportes where nombre = 'Baloncesto'),(select id_centro from centros where nombre = 'Pabellon de Mislata'),1,7.5,'10:00','19:00',10,49,null),
                                            ((select id_deporte from deportes where nombre = 'Baloncesto'),(select id_centro from centros where nombre = 'Pabellon de Mislata'),2,7.5,'10:00','19:00',10,32,null),
                                            ((select id_deporte from deportes where nombre = 'Baloncesto'),(select id_centro from centros where nombre = 'Polideportivo Sedavi'),1,7.5,'10:00','19:00',10,39,null),
                                            ((select id_deporte from deportes where nombre = 'Baloncesto'),(select id_centro from centros where nombre = 'Cross Fitnes Elit SL'),1,7.5,'10:00','20:00',10,45,null),
                                            ((select id_deporte from deportes where nombre = 'Baloncesto'),(select id_centro from centros where nombre = 'Polideportivo Elche'),1,7.5,'10:00','21:00',10,42,null),
                                            ((select id_deporte from deportes where nombre = 'Baloncesto'),(select id_centro from centros where nombre = 'Polideportivo Elche'),2,7.5,'10:00','21:00',10,49,null),
                                            ((select id_deporte from deportes where nombre = 'Baloncesto'),(select id_centro from centros where nombre = 'Polideportivo Municipal Quart De Poblet'),1,7.5,'10:00','22:00',10,42,null),
											((select id_deporte from deportes where nombre = 'Crossfit'),(select id_centro from centros where nombre = 'Cross Fitnes Elit SL'),1,7.5,'10:00','22:00',10,45,null),
											((select id_deporte from deportes where nombre = 'Crossfit'),(select id_centro from centros where nombre = 'Personal Gym'),1,7.5,'10:00','22:00',10,49,null),
                                            ((select id_deporte from deportes where nombre = 'Crossfit'),(select id_centro from centros where nombre = 'Gimnasio Olimpia'),1,7.5,'10:00','22:00',10,32,null),
                                            ((select id_deporte from deportes where nombre = 'Crossfit'),(select id_centro from centros where nombre = 'Club Shidokan'),1,7.5,'10:00','22:00',10,49,null),
                                            ((select id_deporte from deportes where nombre = 'Crossfit'),(select id_centro from centros where nombre = 'Pabellon de Mislata'),1,7.5,'10:00','22:00',10,39,null),
                                            ((select id_deporte from deportes where nombre = 'Crossfit'),(select id_centro from centros where nombre = 'Polideportivo Sedavi'),1,7.5,'10:00','22:00',10,45,null),
                                            ((select id_deporte from deportes where nombre = 'Crossfit'),(select id_centro from centros where nombre = 'Deportivo Burriana'),1,7.5,'10:00','22:00',10,32,null),
                                            ((select id_deporte from deportes where nombre = 'Crossfit'),(select id_centro from centros where nombre = 'Polideportivo Onda'),1,7.5,'10:00','22:00',10,42,null),
                                            ((select id_deporte from deportes where nombre = 'Crossfit'),(select id_centro from centros where nombre = 'Polideportivo Municipal Quart De Poblet'),1,7.5,'10:00','22:00',10,45,null),
                                            ((select id_deporte from deportes where nombre = 'Tenis'),(select id_centro from centros where nombre = 'Pabellon de Mislata'),1,7.5,'10:00','22:00',10,49,null),
											((select id_deporte from deportes where nombre = 'Tenis'),(select id_centro from centros where nombre = 'Pabellon de Mislata'),2,12.5,'10:00','22:00',10,32,null),
                                            ((select id_deporte from deportes where nombre = 'Tenis'),(select id_centro from centros where nombre = 'Polideportivo Sedavi'),1,12.5,'10:00','21:00',10,39,null),
                                            ((select id_deporte from deportes where nombre = 'Tenis'),(select id_centro from centros where nombre = 'Polideportivo Sedavi'),2,12.5,'10:00','21:00',10,45,null),
                                            ((select id_deporte from deportes where nombre = 'Tenis'),(select id_centro from centros where nombre = 'Polideportivo Sedavi'),3,12.5,'10:00','21:00',10,49,null),
                                            ((select id_deporte from deportes where nombre = 'Tenis'),(select id_centro from centros where nombre = 'Polideportivo Municipal Quart De Poblet'),1,12.5,'10:00','20:00',10,49,null),
                                            ((select id_deporte from deportes where nombre = 'Tenis'),(select id_centro from centros where nombre = 'Polideportivo Municipal Quart De Poblet'),2,12.5,'10:00','20:00',10,39,null),
                                            ((select id_deporte from deportes where nombre = 'Tenis'),(select id_centro from centros where nombre = 'Polideportivo Elche'),1,12.5,'10:00','22:00',10,32,null),
                                            ((select id_deporte from deportes where nombre = 'Tenis'),(select id_centro from centros where nombre = 'Polideportivo Elche'),2,12.5,'10:00','22:00',10,45,null),
                                            ((select id_deporte from deportes where nombre = 'Tenis'),(select id_centro from centros where nombre = 'Centro deportivo Walago'),1,12.5,'10:00','22:00',10,42,null),
                                            ((select id_deporte from deportes where nombre = 'Tenis'),(select id_centro from centros where nombre = 'Centro deportivo Walago'),2,12.5,'10:00','22:00',10,39,null),
                                            ((select id_deporte from deportes where nombre = 'Tenis'),(select id_centro from centros where nombre = 'Centro deportivo Castellon'),1,12.5,'10:00','20:00',10,45,null),
											((select id_deporte from deportes where nombre = 'Yoga'),(select id_centro from centros where nombre = 'Club Shidokan'),1,7.5,'10:00','22:00',10,49,null),
                                            ((select id_deporte from deportes where nombre = 'Yoga'),(select id_centro from centros where nombre = 'Personal Gym'),1,7.5,'10:00','22:00',10,32,null),
                                            ((select id_deporte from deportes where nombre = 'Yoga'),(select id_centro from centros where nombre = 'Centro deportivo Walago'),1,7.5,'10:00','22:00',10,42,null),
                                            ((select id_deporte from deportes where nombre = 'Yoga'),(select id_centro from centros where nombre = 'Gimnasio Olimpia'),1,7.5,'10:00','22:00',10,49,null),
                                            ((select id_deporte from deportes where nombre = 'Yoga'),(select id_centro from centros where nombre = 'Polideportivo Sedavi'),1,7.5,'10:00','22:00',10,45,null),
                                            ((select id_deporte from deportes where nombre = 'Yoga'),(select id_centro from centros where nombre = 'Pabellon de Mislata'),1,7.5,'10:00','22:00',10,39,null),
                                            ((select id_deporte from deportes where nombre = 'Yoga'),(select id_centro from centros where nombre = 'Cross Fitnes Elit SL'),1,7.5,'10:00','22:00',10,42,null);                
                                    
 -- eventos
 
insert into eventos values ((select id_deporte from deportes where nombre = 'Atletismo'),(select id_usuario from usuarios where dni ='53250944X'),'2017-12-23','16:00',6,null,20,'Viejo cauce del rio','Valencia','Valencia','España','39.477219','-0.393196'),
							((select id_deporte from deportes where nombre = 'Crossfit'),(select id_usuario from usuarios where dni ='53250944X'),'2017-12-20','17:00',9.5,null,10,'Jardines del Real','Valencia','Valencia','España','39.480190','-0.367740');
 
 -- reservas 
 
 insert into reservas values ((select id_deporte from deportes where nombre = 'Natación'),(select id_centro from centros where nombre = 'Pabellon de Mislata'),1,(select id_usuario from usuarios where nombre ='Asun'),'2018-01-25','18:00','19:00',7.5),
							((select id_deporte from deportes where nombre = 'Tenis'),(select id_centro from centros where nombre = 'Polideportivo Sedavi'),1,(select id_usuario from usuarios where nombre ='Adolfo'),'2018-01-25','18:00','19:00',7.5);
                            
 -- participantes eventos
insert into participantes_evento values ((select id_deporte from deportes where nombre = 'Atletismo'),(select id_usuario from usuarios where dni ='53250944X'),'2017-12-23','16:00',(select id_usuario from usuarios where nombre ='Daniel')),
											((select id_deporte from deportes where nombre = 'Crossfit'),(select id_usuario from usuarios where dni ='53250944X'),'2017-12-20','17:00',(select id_usuario from usuarios where nombre ='Daniel'));
  
  -- imagenes 
  insert into imagenes values (null,'resources/img/Cross-fit-1.jpg','Conviertete en un Crossfit-ero','Ahora te invitamos a la primera clase para que lo pruebes..'),
								(null,'resources/img/favicon.png','MiniLogo',null),
                                (null,'resources/img/girl-warmup.jpg','10ª Maratón valencia trinidad','Apuntate a la 10ª maratón que se celebra en Valencia el dia 28 de noviembre..'),
                                (null,'resources/img/logo-1.PNG','LogoPrincipal',null),
                                (null,'resources/img/teniswetones-blog-0.jpg','Tenis en Valencia','Las mejores pistas de tenis en Valencia ahora a un 20% más barato.');
                                
					