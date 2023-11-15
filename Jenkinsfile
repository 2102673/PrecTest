pipeline {
    agent none
    stages {
        stage('Checkout SCM') {
            agent any
            steps {
                git branch: 'master', url: 'https://github.com/2102673/PrecTest.git'
            }
        }

        stage('SonarQube Analysis') {
            agent any
            steps {
                script {
                    def scannerHome = tool 'SonarQube'
                    withSonarQubeEnv('SonarQube') {
                        sh "${scannerHome}/bin/sonar-scanner -Dsonar.projectKey=OWASP -Dsonar.sources=."
                    }
                }
            }
            post {
                always {
                    script {
                        def issues = scanForIssues tool: [$class: 'SonarQube']
                        recordIssues tool: [$class: 'SonarQube'], issues: issues
                    }
                }
            }
        }

        stage('Integration UI Test') {
    parallel {
        stage('Deploy') {
            agent any
            steps {
                sh './jenkins/scripts/deploy.sh'
                input message: 'Finished using the web site? (Click "Proceed" to continue)'
                sh './jenkins/scripts/kill.sh'
            }
        }
        stage('Headless Browser Test') {
            agent {
                node {
                    label 'docker' // Specify the label of a Docker agent
                }
            }
            steps {
                // Your Docker-related steps go here
            }
            post {
                always {
                    junit 'target/surefire-reports/*.xml'
                }
            }
        }
    }
}
    }
}