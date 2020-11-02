http://cspro.sogang.ac.kr/~cse20172134/request.html
http://cspro.sogang.ac.kr/~cse20172134/search.html
에서 

https://brunch.co.kr/@slowmagazine/104
https://brunch.co.kr/@wanleehani/48

request.html 에서 두개의 URL로 접근 결과 확인해보았음
DB에 저장 (중복된 값 저장 X)

search.html 에서 db에 저장된
class 명과 일치하고 score 값이 같거나 더 큰 값을 찾아내서 뿌려줌

검출되지 않은 이미지는 제외함


public_html 에서 request.html , search.html 파일을 만들고
public_html/cgi-bin 에서 request.php , search.php , request.py 를 만듬

public_html/cgi-bin 에서 simplehtmldom_1_9_1 파일을 넣고 이를 이용하여 php에서 
image분석을 진행함
simplehtmldom_1_9_1 파일 있어야합니다 