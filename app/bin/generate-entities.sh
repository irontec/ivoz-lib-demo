#!/bin/bash

SCRIPT_DIR=$(dirname $(realpath $0))

pushd ${SCRIPT_DIR}/../
  bin/console ivoz:make:entities Demo
  bin/console ivoz:make:interfaces Demo
  bin/console ivoz:make:repositories Demo
popd
