#!/bin/bash
WEBSITE_JP_PATH=../pingcap-jp
PREVIEW_JP_HOST=54.214.163.254
PREVIEW_JP_PATH=/home/ubuntu/project
PREVIEW_JP_PROJECT_PATH=/home/ubuntu/project/website-jp


# remote shell
function sync_to_preview_jp(){
    cd $WEBSITE_JP_PATH

    echo "build ..."
    yarn build
    echo "done"

    cd ..

    echo "making tarball ..."
    tar --exclude='local_config.json' --exclude='node_modules' -czf theme-pingcap-jp.tgz pingcap-jp/
    echo "done"

    echo "copy theme-pingcap-jp.tgz from localhost to service ..."
    rsync -avz --progress theme-pingcap-jp.tgz ubuntu@$PREVIEW_JP_HOST:$PREVIEW_JP_PATH
    echo "done"

    echo "backup theme pingcap jp on service, copy new files"
    ssh ubuntu@$PREVIEW_JP_HOST "cd $PREVIEW_JP_PATH;sudo mv theme-pingcap-jp.tgz $PREVIEW_JP_PROJECT_PATH;cd $PREVIEW_JP_PROJECT_PATH; sh refresh_backup.sh"
    echo "done"

    echo "clear tarball ..."
    rm -f theme-pingcap-jp.tgz
    echo "done"
}

main(){
    sync_to_preview_jp
}

#call sync to preview jp 代码服务器
main
# sync_to_preview_jp