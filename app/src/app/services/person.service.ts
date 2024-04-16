import { Injectable } from '@angular/core';
import { HttpClient, HttpParams, HttpClientModule } from  '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class PersonService {

  private baseUrl = 'http://localhost/api/person2';

  constructor(private http: HttpClient) { }
  getPersons(page: number, size: number, searchQuery: string, orderBy: string | null, orderOperator: string | null): Observable<any> {
    let params = new HttpParams();
    params = params.set('page', String(page));
    params = params.set('size', String(size));
    params = params.set('search', searchQuery);
    if (orderBy !== null) {
      params = params.set('orderBy', orderBy);
    }
    if (orderOperator !== null) {
      params = params.set('orderOperator', orderOperator);
    }
    return this.http.get(`${this.baseUrl}`, { params });
  }
}
