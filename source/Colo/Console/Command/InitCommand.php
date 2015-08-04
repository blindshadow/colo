<?php

namespace Colo\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;

class InitCommand extends Command
{
    protected function configure()
    {
        $this->setName('init');
        $this->setDescription('Create new project of colo into given directory.');
        $this->addArgument('name', InputArgument::OPTIONAL, 'What is the name?');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $handle = new Filesystem();
        $path = './' . $name;
        try {
            if($handle->exists($path)) {
                // 抛出目录已存在错误
                throw new IOException('Directory exists!');
            }

            // 创建目录
            $handle->mkdir(array(
                $path . '/posts',
                $path . '/themes/default/css'
            ));

            // 创建文件
            $handle->touch(array(
                $path . '/config.json',
                $path . '/posts/hello.md',
                $path . '/themes/default/index.tpl',
                $path . '/themes/default/post.tpl'
            ));

            // 填充文件
            $handle->dumpFile($path . '/config.json', 'hello world');
            $handle->dumpFile($path . '/posts/hello.md', 'hello world');
            $handle->dumpFile($path . '/themes/default/index.tpl', 'index-tpl');
            $handle->dumpFile($path . '/themes/default/post.tpl', 'post-tpl');

        } catch (IOException $exception) {
            // 创建项目失败处理异常
            $output->writeln('failed!');
            exit();
        }

        // 输出成功
        $output->writeln('created!');

    }
}