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
    }   
}
