import mysql.connector
from dotenv import load_dotenv
import os

load_dotenv(dotenv_path='../../.env')

RMs = os.listdir("../img")

try:
  banco = mysql.connector.connect(
    host = os.getenv('MYSQL_HOST'),
    user = os.getenv('MYSQL_USER'),
    password = os.getenv('MYSQL_PASSWORD'),
    database = os.getenv('MYSQL_DATABASE')
  )

  if banco.is_connected():
    cursor = banco.cursor()

    for rm in RMs:
      rm = rm[:6]
      cursor.execute("SELECT 1 FROM alunos WHERE rm = %s", [rm])
      alunoExiste = cursor.fetchall()
      if not alunoExiste:
        cursor.execute("INSERT INTO alunos (rm, img) VALUES (%s, %s)", [rm, f"assets/img/{rm}.jpg"])
        banco.commit()
        print(f"Aluno {rm} criado!")
      else:
        print(f"Aluno {rm} já existe")

except mysql.connector.Error as e:
  print(e)

finally:
    if banco.is_connected():
        cursor.close()
        banco.close()
        print("Conexão com o MySQL foi encerrada.")