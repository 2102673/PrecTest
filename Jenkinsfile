pipeline {
    agent none
    stages {
        stage('Checkout SCM') {
            agent any
            steps {
                git branch: 'master', url: 'https://github.com/2102673/PrecTest.git'
            }
        }
    }   
}
