CREATE TABLE tb_usuarios(
	idusuario INT NOT NULL IDENTITY PRIMARY KEY,
    login VARCHAR(64) NOT NULL,
    senha VARCHAR(256) NOT NULL,
    nome VARCHAR(256),
    email VARCHAR(256),
    fone VARCHAR(11),
    nasc DATE,
    funcao varchar(15),
    dtcadastro DATETIME NOT NULL DEFAULT GETDATE()
);
