import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ProjectsService {
  private apiUrl = 'http://127.0.0.1:8000/api/projects';

  constructor(private http: HttpClient) { }

  getProjects(): Observable<any[]> {
    return this.http.get<any[]>(this.apiUrl);
  }
  completeTask(projectId: number, taskId: number) {
    const token = localStorage.getItem('token');

    const headers = {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    };

    return this.http.put(
      `http://127.0.0.1:8000/api/tasks/${projectId}/${taskId}`,
      { completed: true },
      { headers: headers }
    );
  }
  leaveComment(projectId: number, taskId: number, comment: string, userId: number) {
    const token = localStorage.getItem('token');

    const url = `http://127.0.0.1:8000/api/tasks/${projectId}/${taskId}/comments`;

    return this.http.post(
      url,
      { comment, task_id: taskId, user_id: userId },
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
  }




}