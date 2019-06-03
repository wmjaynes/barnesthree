
# Initial deploy

# After rm -rf *
# do the following

cd ~/barnesthree.aactmad.org

# rm -rf *

git clone https://github.com/wmjaynes/barnesthree.git .

cp ~/test/.env .

touch storage/database.sqlite

cp -r ~/temp/B3 storage

composer install

