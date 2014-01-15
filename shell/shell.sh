#shell脚本中 执行SQL语句
export HOST="127.0.0.1";
export USER="user";
export PASSWORD="password";
export DATABASE="test";
DATE=`date +%Y%m --date="+1 month"`; 
export SQL="select * from user";
mysql -u ${USER} -p${PASSWORD} -h${HOST} -D${DATABASE} -e "$SQL";
