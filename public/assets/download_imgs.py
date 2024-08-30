import requests as rq

baseURL = "https://professor.colegiopolitec.com.br/img/aluno/${}.jpg"
for i in range(0, 24):
    for j in range(0,1000):
        rm = "{}{}".format(str(i).zfill(2),str(j).zfill(4))
        url = baseURL.format((rm))

        img = rq.get(url, headers={"User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0"})
        print("baixando {}.jpg // status = {}".format(rm,img.status_code))
        
        if img.status_code == 200:
            with open("img/{}.jpg".format(rm), "wb") as file:
                file.write(img.content)